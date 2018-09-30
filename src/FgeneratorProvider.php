<?php

namespace LifeCode\Fgenerator;

use Illuminate\Support\ServiceProvider;

class FgeneratorProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
