<?php

namespace App\Actions\Fortify;

use App\Enums\RoleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  Request  $request
     * @return Response|JsonResponse
     */
    public function toResponse($request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if user has staff role
        if ($user->hasRoleType(RoleType::STAFF->value)) {
            return redirect()->route('backoffice.dashboard.show');
        }

        // Check if user has client role type
        if ($user->hasRoleType(RoleType::CLIENT->value)) {
            return redirect()->route('app.dashboard.show');
        }

        // Default redirect for any other role types
        return redirect()->intended(config('fortify.home', '/dashboard'));
    }
}
