<?php

namespace App\Providers;

use App\Application\UsesCases\Auth\RegisterUserUseCase;
use App\Domain\Repositories\AuthRepositoryInterface;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Repositories\AuthRepository;
use App\Infrastructure\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class,
            ProductRepositoryInterface::class,
            ProductRepository::class,

        );

        $this->app->bind(RegisterUserUseCase::class, function ($app) {
            return new RegisterUserUseCase(
                $app->make(AuthRepositoryInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
