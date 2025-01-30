<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        $this->registerPolicies();

        // Define a gate for admin access
        Gate::define('admin-access', function ($user) {
            return $user->role === 'admin'; //
        });

        //Define a gate for Admin or Author access
        Gate::define('admin-or-author-access', function ($user){
            return $user->role === 'admin' || $user->role === 'author';
        });

        // Update the last_active timestamp for the authenticated user
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $fiveMinutesAgo = now()->subMinutes(5);

                if ($user->last_active === null || $user->last_active->lessThan($fiveMinutesAgo)) {
                    //Log::info('Updating last_active timestamp.'); // Adding a log to see when updates happen
                    $user->update(['last_active' => now()]);
                }
            }
        });
    }
}
