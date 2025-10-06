<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends BaseBackofficeController
{
    /**
     * Listar FAQs
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $faqs = $query->orderBy('order')->orderBy('created_at')->paginate(15);

        return view('backoffice.faqs.index', compact('faqs'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('backoffice.faqs.create');
    }

    /**
     * Criar nova FAQ
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'created_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.faqs.index', 'FAQ criada com sucesso');
    }

    /**
     * Exibir FAQ específica
     */
    public function show(Faq $faq)
    {
        return view('backoffice.faqs.show', compact('faq'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Faq $faq)
    {
        return view('backoffice.faqs.edit', compact('faq'));
    }

    /**
     * Atualizar FAQ
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
            'updated_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.faqs.index', 'FAQ atualizada com sucesso');
    }

    /**
     * Excluir FAQ
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return $this->redirectWithSuccess('backoffice.faqs.index', 'FAQ excluída com sucesso');
    }
}
