<?php

namespace Mikkellindblom\Utilities\JavaScript;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Mikkellindblom\Utilities\JavaScript\Transformers\Transformer;

class JavaScriptServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('JavaScript', function ($app) {
            return new Transformer(
                new LaravelViewBinder($app['events'], config('javascript.bind_js_vars_to_this_view')),
                config('javascript.js_namespace')
            );
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config/javascript.php', 'javascript'
        );
    }

    /**
     * Publish the plugin configuration.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/javascript.php' => config_path('javascript.php')
        ]);

        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            AliasLoader::getInstance()->alias(
                'JavaScript',
                'Mikkellindblom\Utilities\JavaScript\JavaScriptFacade'
            );
        } else {
            class_alias('Mikkellindblom\Utilities\JavaScript\JavaScriptFacade', 'JavaScript');
        }
    }

}
