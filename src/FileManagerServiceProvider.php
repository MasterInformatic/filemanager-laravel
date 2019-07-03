<?php

namespace MasterInformatic\filemanagerlaravel;

use Illuminate\Support\ServiceProvider;
 
class FileManagerServiceProvider extends ServiceProvider
{
    /** 
     * Register services.
     *
     * @return void
     */ 
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'manager');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'mifilemanager');

        $this->mergeConfigFrom(
            __DIR__.'/config/mifilemanager.php', 'mifilemanager'
        );

        $this->publishes([
            __DIR__.'/config/mifilemanager.php' => config_path('mifilemanager.php'),
        ], 'mifm_config');

        $this->publishes([
            __DIR__.'/Assets' => public_path('FileManager'),
        ], 'mifm_public');


    } 
}
