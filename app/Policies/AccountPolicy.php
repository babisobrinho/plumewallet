<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Account;

class AccountPolicy
{
    /**
     * Determinar se o utilizador pode ver qualquer carteira
     */
    public function viewAny(User $user): bool
    {
        return true; // Utilizadores autenticados podem ver suas próprias carteiras
    }

    /**
     * Determinar se o utilizador pode ver a carteira
     */
    public function view(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determinar se o utilizador pode criar carteiras
     */
    public function create(User $user): bool
    {
        return true; // Utilizadores autenticados podem criar carteiras
    }

    /**
     * Determinar se o utilizador pode atualizar a carteira
     */
    public function update(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determinar se o utilizador pode eliminar a carteira
     */
    public function delete(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determinar se o utilizador pode restaurar a carteira
     */
    public function restore(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determinar se o utilizador pode eliminar permanentemente a carteira
     */
    public function forceDelete(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }
}

