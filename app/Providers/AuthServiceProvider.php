<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /*
    Category Gate
    */
        Gate::define('view-category', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'category'){
                        if ($role->permissions >= 1){
                            return true;
                        }
                    }
                }
            }
            return false;
        });

        Gate::define('create-category', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'category'){
                        if ($role->permissions >= 2){
                            return true;
                        }
                    }
                }
            }
            return false;
        });
        Gate::define('update-category', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'category'){
                        if ($role->permissions >= 3 ){
                            return true;
                        }
                    }
                }
            }
            return false;
        });
        Gate::define('delete-category', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'category'){
                        if ($role->permissions == 4){
                            return true;
                        }
                    }
                }
            }
            return false;
        });

        /*
  User Gate
  */
        Gate::define('view-user', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'user'){
                        if ($role->permissions >= 1){
                            return true;
                        }
                    }
                }
            }
            return false;
        });

        Gate::define('create-user', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'user'){
                        if ($role->permissions >= 2){
                            return true;
                        }
                    }
                }
            }
            return false;
        });
        Gate::define('update-user', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'user'){
                        if ($role->permissions >= 3 ){
                            return true;
                        }
                    }
                }
            }
            return false;
        });
        Gate::define('delete-user', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'user'){
                        if ($role->permissions == 4){
                            return true;
                        }
                    }
                }
            }
            return false;
        });


        Gate::define('view-role', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'role'){
                        if ($role->permissions >= 1 ){
                            return true;
                        }
                    }
                }
            }
            return false;
        });

        Gate::define('create-role', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'role'){
                        if ($role->permissions >= 2 ){
                            return true;
                        }
                    }
                }
            }
            return false;
        });
        Gate::define('update-role', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'role'){
                        if ($role->permissions >= 3 ){
                            return true;
                        }
                    }
                }
            }
            return false;
        });

        Gate::define('delete-role', function ($user) {
            if ($user->role->permissions){
                $roles = json_decode($user->role->permissions);
                foreach ($roles as $role){
                    if ( $role->model == 'role'){
                        if ($role->permissions == 4){
                            return true;
                        }
                    }
                }
            }
            return false;
        });

    }
}
