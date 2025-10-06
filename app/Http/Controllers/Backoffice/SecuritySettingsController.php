<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use Illuminate\Http\Request;

class SecuritySettingsController extends BaseBackofficeController
{
    /**
     * Exibir configurações de segurança
     */
    public function index()
    {
        return view('backoffice.system.security');
    }

    /**
     * Atualizar configurações de segurança
     */
    public function update(Request $request)
    {
        // TODO: Implementar lógica de atualização das configurações de segurança
        // Por enquanto, apenas redireciona com sucesso
        
        return $this->redirectWithSuccess('backoffice.system.security.index', 'Configurações de segurança atualizadas com sucesso');
    }
}
