<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Lead\LeadController;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Settings\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =============================================
// 1. PÁGINAS PÚBLICAS (SEM AUTENTICAÇÃO)
// =============================================
Route::get('/', [PublicController::class, 'landing'])->name('landing');
Route::get('/sobre', [PublicController::class, 'sobreInstitucional'])->name('sobre');
Route::get('/contato', [PublicController::class, 'contatoInstitucional'])->name('contato');
Route::get('/recursos', [PublicController::class, 'recursos'])->name('recursos');

// =============================================
// 2. AUTENTICAÇÃO (BREEZE)
// =============================================
require __DIR__.'/auth.php';

// =============================================
// 3. DASHBOARD (CORRETOR) - AUTENTICADO
// =============================================
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // CRUD de Imóveis
    Route::resource('properties', PropertyController::class);

    // Leads
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::patch('/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.update-status');

    // Configurações
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/profile', [SettingsController::class, 'profile'])->name('profile');
        Route::put('/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
        Route::get('/domain', [SettingsController::class, 'domain'])->name('domain');
        Route::get('/subscription', [SettingsController::class, 'subscription'])->name('subscription');
        Route::get('/credits', [SettingsController::class, 'credits'])->name('credits');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
        Route::get('/account', [SettingsController::class, 'account'])->name('account');
        Route::put('/account/password', [SettingsController::class, 'updatePassword'])->name('account.password');
    });
});


// =============================================
// 4. PAINEL ADMINISTRATIVO (AUTENTICADO + ADMIN)
// =============================================
// NOTA: Nomes definidos diretamente para evitar duplicação (admin.admin.index)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/properties', [AdminController::class, 'properties'])->name('admin.properties');
    Route::delete('/properties/{property}', [AdminController::class, 'destroy'])->name('admin.properties.destroy'); 
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');
});


Route::get('/lp', function () {
    return view('landing.pitch');
})->name('landing.pitch');

// =============================================
// 5. VITRINE DO CORRETOR (LINK DA BIO)
//    DEVE VIR POR ÚLTIMO PARA NÃO CAPTURAR ROTAS ESPECÍFICAS
// =============================================
Route::prefix('{slug}')->group(function () {
    Route::get('/', [PublicController::class, 'corretor'])->name('public.home');
    Route::get('/imovel/{propertySlug}', [PublicController::class, 'imovelDetalhe'])->name('public.imovel.detalhe');
    Route::get('/sobre', [PublicController::class, 'sobre'])->name('public.sobre');
    Route::get('/contato', [PublicController::class, 'contato'])->name('public.contato');

    // AJAX - Filtros e captura de lead
    Route::post('/filtrar', [PublicController::class, 'filtrar'])->name('public.filtrar');
    Route::post('/lead/{propertyId}', [PublicController::class, 'storeLead'])->name('public.lead.store');
});