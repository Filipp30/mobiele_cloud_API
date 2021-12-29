<?php

namespace App\Providers\RepositoryProviders;

use App\Repository\ModelContracts\AuthContract;
use App\Repository\ModelServices\AuthService;
use Illuminate\Support\ServiceProvider;

class AuthContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthContract::class,AuthService::class);
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
