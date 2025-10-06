<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseBackofficeController extends Controller
{
    /**
     * Constructor - aplicar middleware de admin
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        // TODO: Adicionar middleware de admin quando implementado
        // $this->middleware('admin');
    }

    /**
     * Resposta JSON padronizada para APIs
     */
    protected function jsonResponse($data = null, $message = null, $status = 200)
    {
        return response()->json([
            'success' => $status < 400,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Resposta de sucesso
     */
    protected function success($data = null, $message = 'Operação realizada com sucesso')
    {
        return $this->jsonResponse($data, $message, 200);
    }

    /**
     * Resposta de erro
     */
    protected function error($message = 'Erro na operação', $status = 400)
    {
        return $this->jsonResponse(null, $message, $status);
    }

    /**
     * Redirecionamento com mensagem de sucesso
     */
    protected function redirectWithSuccess($route, $message = 'Operação realizada com sucesso')
    {
        return redirect()->route($route)->with('success', $message);
    }

    /**
     * Redirecionamento com mensagem de erro
     */
    protected function redirectWithError($route, $message = 'Erro na operação')
    {
        return redirect()->route($route)->with('error', $message);
    }

    /**
     * Validar permissões de admin
     */
    protected function checkAdminPermission()
    {
        // TODO: Implementar verificação de permissões
        // Por enquanto, apenas verificar se está autenticado
        if (!auth()->check()) {
            abort(403, 'Acesso negado');
        }
    }
}
