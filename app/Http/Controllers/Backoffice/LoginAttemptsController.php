<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Backoffice\BaseBackofficeController;
use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class LoginAttemptsController extends BaseBackofficeController
{
    /**
     * Listar tentativas de login
     */
    public function index(Request $request)
    {
        $query = LoginAttempt::with('user');

        // Filtros
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('success')) {
            $query->where('success', $request->success === 'true');
        }

        if ($request->filled('ip_address')) {
            $query->where('ip_address', 'like', "%{$request->ip_address}%");
        }

        $attempts = $query->orderBy('attempted_at', 'desc')->paginate(50);

        return view('backoffice.login-attempts.index', compact('attempts'));
    }

    /**
     * Exibir tentativa específica
     */
    public function show(LoginAttempt $loginAttempt)
    {
        $loginAttempt->load('user');
        return view('backoffice.login-attempts.show', compact('loginAttempt'));
    }
}
