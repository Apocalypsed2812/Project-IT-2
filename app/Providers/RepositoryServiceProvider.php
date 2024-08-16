<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repos\Eloquent\BaseRepository;
use App\Repos\EloquentRepositoryInterface;

use App\Repos\Eloquent\AccountRepository;
use App\Repos\AccountRepositoryInterface;

use App\Repos\Eloquent\ProductRepository;
use App\Repos\ProductRepositoryInterface;

use App\Repos\Eloquent\SyncRepository;
use App\Repos\SyncRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(SyncRepositoryInterface::class, SyncRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
