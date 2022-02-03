<?php

namespace App\Providers;

use App\Contracts\Dao\CategoryDaoInterface;
use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Dao\CategoryDao;
use App\Dao\PostDao;
use App\Dao\UserDao;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\UserService;
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
        $this->app->bind(UserDaoInterface::class, UserDao::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

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