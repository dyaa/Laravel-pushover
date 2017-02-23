<?php namespace Dyaa\Pushover;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PushoverServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('pushover', function($app)
        {
            return new Pushover($app['config']);
        });

        $this->app->booting(function()
        {
            $loader = AliasLoader::getInstance();
            $loader->alias('Pushover', 'Dyaa\Pushover\Facades\Pushover');
        });

        $this->app->singleton('pushover.send', function ()
        {
            return new Commands\PushoverCommand($this->app['pushover']);
        });

        $this->commands(
            'pushover.send'
        );
    }

    /**
     * Get the services provided by the provider.    
     *
     * @return array
     */
    public function provides()
    {
        return ['pushover'];
    }

}
