<?php

namespace LifeCode\Fgenerator;

use Illuminate\Support\ServiceProvider;
use LifeCode\Fgenerator\Generator\FgeneratorCommand;

class FgeneratorProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FgeneratorCommand::class
            ]);
        }

        $this->publishes([
            __DIR__.'/Generator/static' => public_path('/'),
        ], 'fgenerator');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("fgenerator", function(){

            return new Fgenerator();
        });
    }
}
