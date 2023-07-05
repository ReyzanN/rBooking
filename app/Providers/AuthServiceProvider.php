<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /*
         * User Consultant Rank
         */
        Gate::define('UserConsultant',function(){
            if (auth()->user()->IsConsultant()){
                return  true;
            }
            return false;
        });

        /*
         * User Admin Rank
         */
        Gate::define('UserAdmin',function(){
            if (auth()->user()->IsAdmin()) {
                return true;
            }
            return false;
        });

        /*
         * User
         */
        Gate::define('UserSuperAdmin', function(){
            if (auth()->user()->IsSuerAdmin()){
                return true;
            }
           return false;
        });
    }
}
