<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Conference;
use App\Policies\ConferencePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Conference::class => ConferencePolicy::class,
        
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manageConferences', function (User $user) {
            return $user->hasRole('Admin');
        });
    }
}
