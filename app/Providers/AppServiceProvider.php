<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        Gate::define('admin', function(User $user) {
           return $user->is_admin;
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });

        Gate::define('kades', function (User $user) {
            return $user->role === 'kades';
        });

        Gate::define('sekdes', function (User $user) {
            return $user->role === 'sekdes';
        });
    }
}
