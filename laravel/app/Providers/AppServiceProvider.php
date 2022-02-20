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
        // RegistUserRepositoryInterfaceとRegistUserRepositoryを結合する
        $this->app->bind(
            \App\Http\Infrastracture\UserRepositoryInterface::class,
            \App\Models\Repository\User\UserRepository::class
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
