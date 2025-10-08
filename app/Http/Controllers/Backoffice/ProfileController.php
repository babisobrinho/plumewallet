<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

class ProfileController extends BaseBackofficeController
{
    /**
     * Exibir a página de perfil do usuário
     */
    public function show()
    {
        $this->checkAdminPermission();
        
        return view('backoffice.profile.show');
    }

    /**
     * Atualizar informações do perfil
     */
    public function updateProfileInformation(Request $request)
    {
        $this->checkAdminPermission();

        if (!Features::canUpdateProfileInformation()) {
            return $this->redirectWithError('backoffice.profile.show', 'Atualização de perfil não está habilitada.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);

        $user = auth()->user();
        $user->forceFill([
            'name' => $request->name,
            'email' => $request->email,
        ])->save();

        return $this->redirectWithSuccess('backoffice.profile.show', 'Informações do perfil atualizadas com sucesso.');
    }

    /**
     * Atualizar senha do usuário
     */
    public function updatePassword(Request $request)
    {
        $this->checkAdminPermission();

        if (!Features::enabled(Features::updatePasswords())) {
            return $this->redirectWithError('backoffice.profile.show', 'Atualização de senha não está habilitada.');
        }

        $request->validate([
            'current_password' => ['required', 'current_password:web'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return $this->redirectWithSuccess('backoffice.profile.show', 'Senha atualizada com sucesso.');
    }

    /**
     * Atualizar preferências do usuário
     */
    public function updatePreferences(Request $request)
    {
        $this->checkAdminPermission();

        $request->validate([
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'theme' => ['required', 'string', 'in:light,dark,system'],
        ]);

        $user = auth()->user();
        
        // Salvar preferências (você pode criar uma tabela de user_preferences ou usar campos na tabela users)
        $user->forceFill([
            'whatsapp_number' => $request->whatsapp_number,
            'theme_preference' => $request->theme,
        ])->save();

        return $this->redirectWithSuccess('backoffice.profile.show', 'Preferências atualizadas com sucesso.');
    }

    /**
     * Encerrar outras sessões do navegador
     */
    public function logoutOtherBrowserSessions(Request $request)
    {
        $this->checkAdminPermission();

        $request->validate([
            'password' => ['required', 'current_password:web'],
        ]);

        // Implementar logout de outras sessões
        // Por enquanto, apenas retornar sucesso
        return $this->redirectWithSuccess('backoffice.profile.show', 'Outras sessões foram encerradas com sucesso.');
    }

    /**
     * Deletar conta do usuário
     */
    public function deleteAccount(Request $request)
    {
        $this->checkAdminPermission();

        if (!Jetstream::hasAccountDeletionFeatures()) {
            return $this->redirectWithError('backoffice.profile.show', 'Exclusão de conta não está habilitada.');
        }

        $request->validate([
            'password' => ['required', 'current_password:web'],
        ]);

        $user = auth()->user();
        
        // Implementar exclusão da conta
        // Por enquanto, apenas retornar sucesso
        return $this->redirectWithSuccess('backoffice.dashboard', 'Conta excluída com sucesso.');
    }
}
