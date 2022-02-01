<?php

namespace App\Providers;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Repositories\Dao\CategoryDao;
use App\Repositories\Dao\PostDao;
use App\Repositories\Services\CategoryService;
use App\Repositories\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(PostDaoInterface::class, PostDao::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CategoryDaoInterface::class, CategoryDao::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}