<?php

namespace App\Providers;

use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\RatingsRepository\RatingRepositoryInterface;
use App\Repositories\AdminRepository\AdminRepositoryInterface;
use App\Repositories\BookRepository\BookRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\RatingsRepository\RatingRepository;
use App\Repositories\AdminRepository\AdminRepository;
use App\Repositories\BookRepository\BookRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(RatingRepositoryInterface::class, RatingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
