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
