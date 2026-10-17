<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Processa o login e redireciona conforme o tipo de usuário.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Admin → /admin | Corretor → /dashboard
        // O intended() preserva a URL que o usuário tentou acessar antes do login
        if (auth()->user()->is_admin) {
            return redirect()->intended(route('admin.index', absolute: false));
        }

        return redirect()->intended(route('dashboard.index', absolute: false));
    }

    /**
     * Encerra a sessão.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}