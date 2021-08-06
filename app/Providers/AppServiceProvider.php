<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Helper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // bind repository
        $this->app->bind(
            \App\Contracts\Repository\TodoRepository::class,
            \App\Repositories\Eloquent\TodoRepository::class
        );

        // bind service
        $this->app->bind(
            \App\Contracts\Service\TodoService::class,
            \App\Services\TodoService::class
        );

        // シングルトンパターンを参照してね
        $this->app->singleton('app-helper', Helper::class);
    }
}
