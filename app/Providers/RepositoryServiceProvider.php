<?php

namespace App\Providers;

use App\Contracts\AdminUserContract;
use App\Contracts\RoleContract;
use App\Repositories\AdminUserRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;



class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $repositories = [
        CategoryContract::class  =>  CategoryRepository::class,
        RoleContract::class    => RoleRepository::class,
        AdminUserContract::class   => AdminUserRepository::class,

    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation){
            $this->app->bind($interface,$implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
