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
        //
         // require_once __DIR__ . '/Helpers/HumanizeFolders.php';
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


    } 
}
