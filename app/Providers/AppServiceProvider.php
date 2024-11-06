<?php

namespace App\Providers;

use App\Repositories\PostRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /* Bind the Interface to an Implementation */
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('isAdmin', function ($user) {
            return $user->role->id === 1;
        });

        Gate::define('isUser', function ($user) {
            return $user->role->id === 2;
        });

    }
}
