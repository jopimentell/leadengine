<?php

namespace App\Providers;

use App\Models\Property;
use App\Policies\PropertyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Property::class => PropertyPolicy::class,
        // Adicione outras policies aqui se necessário
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Opcional: Gate para verificar limite de imóveis
        Gate::define('add-property', function ($user) {
            return $user->canAddMoreProperties();
        });

        // Opcional: Gate para acesso ao dashboard
        Gate::define('view-dashboard', function ($user) {
            return $user !== null;
        });
    }
}