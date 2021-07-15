<?php

namespace App\Providers;

use App\Http\Helpers\Response\ApiResponse;

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
            'App\Repositories\Process\ProcessRepositoryInterface',
            'App\Repositories\Process\ProcessRepository'
        );

        $this->app->bind(ResponseInterface::class, function () {
            return new ApiResponse();
        });
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
