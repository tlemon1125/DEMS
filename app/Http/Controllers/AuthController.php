<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function show(): Response {
        return Inertia::render('Auth/Login');
    }

    public function authenticate(LoginRequest $request): RedirectResponse {
        $user = $request->authenticate();

        $request->session()->regenerate();

        $roleRoute = "";

        if($user->role_id === 0) {
            $roleRoute = "student.dashboard";
        }
        elseif($user->role_id === 1) {
            $roleRoute = "coordinator.dashboard";
        }
        elseif($user->role_id === 2) {
            $roleRoute = "academic.dashboard";
        }

        return redirect()->route($roleRoute);
    }

    public function logout(Request $request): RedirectResponse 
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
