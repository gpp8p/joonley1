<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-dashboard', function ($user) {
            return $user->hasAccess(['admin-dashboard']);
        });

        Gate::define('create-data', function ($user) {
            return $user->hasAccess(['create-data']);
        });

        Gate::define('update-data', function ($user) {
            return $user->hasAccess(['update-data']);
        });

        Gate::define('read-data', function ($user) {
            return $user->hasAccess(['read-data']);
        });

        Gate::define('delete-data', function ($user) {
            return $user->hasAccess(['delete-data']);
        });

        Gate::define('edit-users', function ($user) {
            return $user->hasAccess(['edit-users']);
        });
    }
}
