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
        //gate voor na te kijken of je ingelogd bent met de admin user
        Gate::define('admin-only', function($user) {
           if($user->id == 1 || $user->email == 'admin@mail.com') {
               return true;
           } else {
               return false;
           }
        });
        //
    }
}
