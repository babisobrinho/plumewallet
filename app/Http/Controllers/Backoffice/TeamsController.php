<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends BaseBackofficeController
{
    /**
     * Listar teams
     */
    public function index(Request $request)
    {
        $query = Team::with(['owner', 'users']);

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $teams = $query->latest()->paginate(15);

        return view('backoffice.teams.index', compact('teams'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('backoffice.teams.create');
    }

    /**
     * Criar nova team
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_members' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'user_id' => auth()->id(), // Campo obrigatório - dono da team
            'description' => $request->description,
            'max_members' => $request->max_members,
            'is_active' => $request->boolean('is_active', true),
            'personal_team' => false, // Teams do backoffice não são pessoais
            'created_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.teams.index', 'Team criada com sucesso');
    }

    /**
     * Exibir team específica
     */
    public function show(Team $team)
    {
        $team->load(['owner', 'users']);
        return view('backoffice.teams.show', compact('team'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Team $team)
    {
        return view('backoffice.teams.edit', compact('team'));
    }

    /**
     * Atualizar team
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_members' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $team->update([
            'name' => $request->name,
            'description' => $request->description,
            'max_members' => $request->max_members,
            'is_active' => $request->boolean('is_active'),
        ]);

        return $this->redirectWithSuccess('backoffice.teams.index', 'Team atualizada com sucesso');
    }

    /**
     * Alternar status da team
     */
    public function toggleStatus(Team $team)
    {
        $team->update([
            'is_active' => !$team->is_active,
        ]);

        $message = $team->is_active ? 'Team ativada com sucesso' : 'Team desativada com sucesso';
        return $this->redirectWithSuccess('backoffice.teams.index', $message);
    }

    /**
     * Excluir team
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return $this->redirectWithSuccess('backoffice.teams.index', 'Team excluída com sucesso');
    }
}
