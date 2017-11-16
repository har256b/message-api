<?php

namespace App\Providers;

use App\Repositories\Contracts\MessageRepository;
use App\Repositories\EloquentMessageRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MessageRepository::class, function () {
            return new EloquentMessageRepository();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            MessageRepository::class
        ];
    }
}