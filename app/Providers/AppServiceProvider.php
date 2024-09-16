<?php

namespace App\Providers;

use App\Repositories\LeadRepository;
use App\Repositories\RepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        /** My Repositories */
        $this->app->bind(
            abstract: RepositoryInterface::class
            , concrete: UserRepository::class
        );
        $this->app->bind(
            abstract: RepositoryInterface::class
            , concrete: LeadRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
