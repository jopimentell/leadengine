<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function profile()
    {
        return view('dashboard.settings.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'city' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:users,slug,' . $user->id . '|regex:/^[a-z0-9\-]+$/',
            'creci' => 'nullable|string|max:50',
            'avatar' => 'nullable|image|max:2048',
        ], [
        'slug.regex' => 'O slug deve conter apenas letras minúsculas, números e hífens.',
        'slug.unique' => 'Este slug já está em uso. Escolha outro.',
    ]);

        $validated['slug'] = Str::slug($validated['slug']);

        $exists = User::where('slug', $validated['slug'])
            ->where('id', '!=', $user->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['slug' => 'Este slug já está em uso. Escolha outro.']);
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $path;
        }

        $user->update($validated);
        return back()->with('success', 'Perfil atualizado!');
    }

    public function domain()
    {
        return view('dashboard.settings.domain');
    }

    public function subscription()
    {
        return view('dashboard.settings.subscription');
    }

    public function credits()
    {
        return view('dashboard.settings.credits');
    }

    public function notifications()
    {
        return view('dashboard.settings.notifications');
    }

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();
        $preferences = $user->preferences ?? [];
        $preferences['whatsapp'] = $request->has('whatsapp_notifications');
        $preferences['email'] = $request->has('email_notifications');
        $preferences['weekly_report'] = $request->has('weekly_report');
        $user->preferences = $preferences;
        $user->save();

        return back()->with('success', 'Preferências salvas!');
    }

    public function account()
    {
        return view('dashboard.settings.account');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|confirmed|min:8',
        ]);

        Auth::user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Senha alterada!');
    }
}