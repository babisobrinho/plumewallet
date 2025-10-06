<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\Integration;
use Illuminate\Http\Request;

class IntegrationsController extends BaseBackofficeController
{
    /**
     * Listar integrações
     */
    public function index()
    {
        $integrations = Integration::latest()->paginate(15);
        return view('backoffice.integrations.index', compact('integrations'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        return view('backoffice.integrations.create');
    }

    /**
     * Criar nova integração
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:payment,sms,email,analytics,storage,other',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'webhook_url' => 'nullable|url',
        ]);

        $integration = Integration::create([
            'name' => $request->name,
            'type' => $request->type,
            'api_key' => $request->api_key,
            'api_secret' => $request->api_secret,
            'webhook_url' => $request->webhook_url,
            'created_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.integrations.index', 'Integração criada com sucesso');
    }

    /**
     * Exibir integração específica
     */
    public function show(Integration $integration)
    {
        return view('backoffice.integrations.show', compact('integration'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Integration $integration)
    {
        return view('backoffice.integrations.edit', compact('integration'));
    }

    /**
     * Atualizar integração
     */
    public function update(Request $request, Integration $integration)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:payment,sms,email,analytics,storage,other',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'webhook_url' => 'nullable|url',
        ]);

        $integration->update([
            'name' => $request->name,
            'type' => $request->type,
            'api_key' => $request->api_key,
            'api_secret' => $request->api_secret,
            'webhook_url' => $request->webhook_url,
            'updated_by' => auth()->id(),
        ]);

        return $this->redirectWithSuccess('backoffice.integrations.index', 'Integração atualizada com sucesso');
    }

    /**
     * Alternar status da integração
     */
    public function toggle(Integration $integration)
    {
        $integration->update([
            'is_active' => !$integration->is_active,
        ]);

        $message = $integration->is_active ? 'Integração ativada com sucesso' : 'Integração desativada com sucesso';
        return $this->redirectWithSuccess('backoffice.integrations.index', $message);
    }

    /**
     * Excluir integração
     */
    public function destroy(Integration $integration)
    {
        $integration->delete();
        return $this->redirectWithSuccess('backoffice.integrations.index', 'Integração excluída com sucesso');
    }
}
