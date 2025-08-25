<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetEnvelope;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Obter budget do mês atual ou criar um novo
        $currentBudget = Budget::forUser($user->id)
            ->currentMonth()
            ->with(['envelopes.category'])
            ->first();
            
        if (!$currentBudget) {
            $currentBudget = $this->createCurrentMonthBudget($user);
        }
        
        // Obter categorias de despesa para criar envelopes
        $expenseCategories = Category::where('user_id', $user->id)
            ->where('type', 'expense')
            ->get();
            
        // Calcular totais
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'income')
            ->whereBetween('transaction_date', [$currentBudget->start_date, $currentBudget->end_date])
            ->sum('amount');
            
        $totalSpent = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'expense')
            ->whereBetween('transaction_date', [$currentBudget->start_date, $currentBudget->end_date])
            ->sum('amount');
            
        // Atualizar budget com valores reais
        $currentBudget->update([
            'total_income' => $totalIncome,
            'total_spent' => $totalSpent
        ]);
        
        // Atualizar envelopes com gastos reais
        foreach ($currentBudget->envelopes as $envelope) {
            $spent = Transaction::where('user_id', $user->id)
                ->where('category_id', $envelope->category_id)
                ->where('transaction_type', 'expense')
                ->whereBetween('transaction_date', [$currentBudget->start_date, $currentBudget->end_date])
                ->sum('amount');
                
            $envelope->update(['spent_amount' => $spent]);
            $envelope->calculateAvailable();
            $envelope->updateStatus();
        }
        
        // Recalcular total disponível
        $currentBudget->calculateAvailable();
        
        return view('budget.index', compact('currentBudget', 'expenseCategories', 'totalIncome', 'totalSpent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)
            ->where('type', 'expense')
            ->get();
            
        return view('budget.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'envelopes' => 'array',
            'envelopes.*.category_id' => 'required|exists:categories,id',
            'envelopes.*.budgeted_amount' => 'required|numeric|min:0'
        ]);
        
        $user = Auth::user();
        
        $budget = Budget::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_income' => 0,
            'total_budgeted' => 0,
            'total_spent' => 0,
            'total_available' => 0
        ]);
        
        // Criar envelopes
        if ($request->envelopes) {
            $totalBudgeted = 0;
            foreach ($request->envelopes as $envelopeData) {
                BudgetEnvelope::create([
                    'budget_id' => $budget->id,
                    'category_id' => $envelopeData['category_id'],
                    'budgeted_amount' => $envelopeData['budgeted_amount'],
                    'spent_amount' => 0,
                    'available_amount' => $envelopeData['budgeted_amount'],
                    'rollover_amount' => 0,
                    'status' => 'active'
                ]);
                
                $totalBudgeted += $envelopeData['budgeted_amount'];
            }
            
            $budget->update(['total_budgeted' => $totalBudgeted]);
            $budget->calculateAvailable();
        }
        
        return redirect()->route('budget.index')->with('success', 'Budget criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);
        
        $budget->load(['envelopes.category']);
        
        return view('budget.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        $this->authorize('update', $budget);
        
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)
            ->where('type', 'expense')
            ->get();
            
        return view('budget.edit', compact('budget', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'envelopes' => 'array',
            'envelopes.*.id' => 'sometimes|exists:budget_envelopes,id',
            'envelopes.*.category_id' => 'required|exists:categories,id',
            'envelopes.*.budgeted_amount' => 'required|numeric|min:0'
        ]);
        
        $budget->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        
        // Atualizar envelopes
        if ($request->envelopes) {
            $totalBudgeted = 0;
            
            // Remover envelopes não incluídos
            $envelopeIds = collect($request->envelopes)->pluck('id')->filter();
            if ($envelopeIds->isNotEmpty()) {
                BudgetEnvelope::where('budget_id', $budget->id)
                    ->whereNotIn('id', $envelopeIds)
                    ->delete();
            }
            
            foreach ($request->envelopes as $envelopeData) {
                if (isset($envelopeData['id'])) {
                    // Atualizar envelope existente
                    $envelope = BudgetEnvelope::find($envelopeData['id']);
                    $envelope->update([
                        'budgeted_amount' => $envelopeData['budgeted_amount']
                    ]);
                    $envelope->calculateAvailable();
                    $envelope->updateStatus();
                } else {
                    // Criar novo envelope
                    BudgetEnvelope::create([
                        'budget_id' => $budget->id,
                        'category_id' => $envelopeData['category_id'],
                        'budgeted_amount' => $envelopeData['budgeted_amount'],
                        'spent_amount' => 0,
                        'available_amount' => $envelopeData['budgeted_amount'],
                        'rollover_amount' => 0,
                        'status' => 'active'
                    ]);
                }
                
                $totalBudgeted += $envelopeData['budgeted_amount'];
            }
            
            $budget->update(['total_budgeted' => $totalBudgeted]);
            $budget->calculateAvailable();
        }
        
        return redirect()->route('budget.index')->with('success', 'Budget atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);
        
        $budget->delete();
        
        return redirect()->route('budget.index')->with('success', 'Budget removido com sucesso!');
    }
    
    /**
     * Criar budget para o mês atual
     */
    private function createCurrentMonthBudget($user)
    {
        $now = Carbon::now();
        $startDate = $now->copy()->startOfMonth();
        $endDate = $now->copy()->endOfMonth();
        
        $budget = Budget::create([
            'user_id' => $user->id,
            'name' => $startDate->format('F Y'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_income' => 0,
            'total_budgeted' => 0,
            'total_spent' => 0,
            'total_available' => 0
        ]);
        
        // Criar envelopes para todas as categorias de despesa
        $categories = Category::where('user_id', $user->id)
            ->where('type', 'expense')
            ->get();
            
        foreach ($categories as $category) {
            BudgetEnvelope::create([
                'budget_id' => $budget->id,
                'category_id' => $category->id,
                'budgeted_amount' => 0,
                'spent_amount' => 0,
                'available_amount' => 0,
                'rollover_amount' => 0,
                'status' => 'active'
            ]);
        }
        
        return $budget;
    }
}
