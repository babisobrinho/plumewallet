<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use Illuminate\Http\Request;

class SystemSettingsController extends BaseBackofficeController
{
    /**
     * Exibir configurações do sistema
     */
    public function index()
    {
        return view('backoffice.system.settings');
    }

    /**
     * Atualizar configurações do sistema
     */
    public function update(Request $request)
    {
        // TODO: Implementar lógica de atualização das configurações
        // Por enquanto, apenas redireciona com sucesso
        
        return $this->redirectWithSuccess('backoffice.system.settings.index', 'Configurações atualizadas com sucesso');
    }
}
