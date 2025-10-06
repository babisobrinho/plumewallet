<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends BaseBackofficeController
{
    /**
     * Listar usuários
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->latest()->paginate(15);

        return view('backoffice.users.index', compact('users'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('backoffice.users.create');
    }

    /**
     * Criar novo usuário
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'timezone' => 'nullable|string',
            'locale' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'timezone' => $request->timezone ?? 'UTC',
            'locale' => $request->locale ?? 'pt',
            'is_active' => $request->boolean('is_active', true),
        ]);

        return $this->redirectWithSuccess('backoffice.users.index', 'Usuário criado com sucesso');
    }

    /**
     * Exibir usuário específico
     */
    public function show(User $user)
    {
        $user->load(['loginAttempts', 'supportTickets', 'blogPosts']);
        return view('backoffice.users.show', compact('user'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(User $user)
    {
        return view('backoffice.users.edit', compact('user'));
    }

    /**
     * Atualizar usuário
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => 'nullable|string|min:8|confirmed',
            'timezone' => 'nullable|string',
            'locale' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'timezone' => $request->timezone,
            'locale' => $request->locale,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return $this->redirectWithSuccess('backoffice.users.index', 'Usuário atualizado com sucesso');
    }

    /**
     * Desativar usuário
     */
    public function deactivate(User $user)
    {
        $user->update([
            'is_active' => false,
            'deactivated_at' => now(),
        ]);

        return $this->redirectWithSuccess('backoffice.users.index', 'Usuário desativado com sucesso');
    }

    /**
     * Ativar usuário
     */
    public function activate(User $user)
    {
        $user->update([
            'is_active' => true,
            'deactivated_at' => null,
        ]);

        return $this->redirectWithSuccess('backoffice.users.index', 'Usuário ativado com sucesso');
    }

    /**
     * Excluir usuário
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->redirectWithSuccess('backoffice.users.index', 'Usuário excluído com sucesso');
    }
}
