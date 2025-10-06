<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportController extends BaseBackofficeController
{
    /**
     * Listar tickets de suporte
     */
    public function index(Request $request)
    {
        $query = SupportTicket::with(['user', 'category', 'assignedAgent']);

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('ticket_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->latest()->paginate(15);

        return view('backoffice.support.tickets.index', compact('tickets'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('backoffice.support.tickets.create');
    }

    /**
     * Criar novo ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $ticket = SupportTicket::create([
            'ticket_number' => 'TKT-' . date('Y') . '-' . str_pad(SupportTicket::count() + 1, 3, '0', STR_PAD_LEFT),
            'subject' => $request->subject,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'user_id' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.support.tickets.index', 'Ticket criado com sucesso');
    }

    /**
     * Exibir ticket específico
     */
    public function show(SupportTicket $ticket)
    {
        $ticket->load(['user', 'category', 'assignedAgent', 'messages']);
        return view('backoffice.support.tickets.show', compact('ticket'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(SupportTicket $ticket)
    {
        return view('backoffice.support.tickets.edit', compact('ticket'));
    }

    /**
     * Atualizar ticket
     */
    public function update(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:open,in_progress,waiting_customer,resolved,closed',
        ]);

        $ticket->update([
            'subject' => $request->subject,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return $this->redirectWithSuccess('backoffice.support.tickets.index', 'Ticket atualizado com sucesso');
    }

    /**
     * Atribuir ticket a um agente
     */
    public function assign(Request $request, SupportTicket $ticket)
    {
        $request->validate([
            'assigned_agent_id' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'assigned_agent_id' => $request->assigned_agent_id,
            'status' => 'in_progress',
        ]);

        return $this->redirectWithSuccess('backoffice.support.tickets.show', 'Ticket atribuído com sucesso', $ticket);
    }

    /**
     * Fechar ticket
     */
    public function close(SupportTicket $ticket)
    {
        $ticket->update([
            'status' => 'closed',
            'resolution_date' => now(),
        ]);

        return $this->redirectWithSuccess('backoffice.support.tickets.index', 'Ticket fechado com sucesso');
    }

    /**
     * Excluir ticket
     */
    public function destroy(SupportTicket $ticket)
    {
        $ticket->delete();
        return $this->redirectWithSuccess('backoffice.support.tickets.index', 'Ticket excluído com sucesso');
    }
}
