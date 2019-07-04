<?php

namespace Stock\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Stock\Repositories\UserRepository',
            'Stock\Repositories\UserRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\CompanyRepository',
            'Stock\Repositories\CompanyRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\StockRepository',
            'Stock\Repositories\StockRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\OutRepository',
            'Stock\Repositories\OutRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\RoadRepository',
            'Stock\Repositories\RoadRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\ProtocolRepository',
            'Stock\Repositories\ProtocolRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\UserProtocolRepository',
            'Stock\Repositories\UserProtocolRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\ConfigurationFiscalRepository',
            'Stock\Repositories\ConfigurationFiscalRepositoryEloquent'
        );
        $this->app->bind(
            'Stock\Repositories\NotaFiscalRepository',
            'Stock\Repositories\NotaFiscalRepositoryEloquent'
        );
    }
}
