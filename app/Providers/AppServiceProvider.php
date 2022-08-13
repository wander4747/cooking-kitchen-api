<?php
namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Admin\Contracts\CategoryRepositoryInterface',
            'App\Repositories\Admin\Eloquent\CategoryRepository',
        );
        $this->app->bind(
            'App\Repositories\Admin\Contracts\RecipeRepositoryInterface',
            'App\Repositories\Admin\Eloquent\RecipeRepository',
        );
        $this->app->bind(
            'App\Repositories\Admin\Contracts\TipRepositoryInterface',
            'App\Repositories\Admin\Eloquent\TipRepository',
        );
        $this->app->bind(
            'App\Repositories\Admin\Contracts\UserRepositoryInterface',
            'App\Repositories\Admin\Eloquent\UserRepository',
        );
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
