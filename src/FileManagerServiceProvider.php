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
        //

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'manager');

        $this->mergeConfigFrom(
            __DIR__.'/config/mifilemanager.php', 'mifilemanager'
        );

        $this->publishes([
            __DIR__.'/config/mifilemanager.php' => config_path('mifilemanager.php'),
        ]);

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/mi/filemanager'),
        ]);

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/mi/filemanager'),
        ]);

        $this->publishes([
            __DIR__.'/Assets' => public_path('FileManager'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Assets/css/FileManager.css' => public_path('css'),
        ], 'public');


    } 
}
