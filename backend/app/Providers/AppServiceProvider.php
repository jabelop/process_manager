<?php

namespace App\Providers;

use App\Http\Helpers\Response\ApiResponse;
use App\Http\Helpers\Response\ResponseInterface;
use App\Repositories\ProcessType\ProcessTypeRepository;
use App\Repositories\ProcessType\ProcessTypeRepositoryInterface;
use App\Models\ProcessType;


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
            'App\Repositories\Process\ProcessRepository',
            'App\Repositories\ProcessType\ProcessTypeRepositoryInterface',
            'App\Repositories\ProcessType\ProcessTypeRepository'
        );

        $this->app->bind(ResponseInterface::class, function () {
            return new ApiResponse();
        });

        $this->app->bind(ProcessTypeRepositoryInterface::class, function () {
            return new ProcessTypeRepository(new ProcessType());
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
