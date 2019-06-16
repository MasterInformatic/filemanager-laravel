<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;

use MasterInformatic\filemanagerlaravel\Filesystem\ScanDir;

class Build extends ScanDir{ 

  public static $menu;

  public static function main(){ 
    $response = self::scanDos(config('mifilemanager.dir'));
    return self::isDirectoryReaderDos($response);
  }

  public static function isDirectoryReaderDos($items){
        foreach ($items as $i) {
               if($i->type=="folder"){
                    self::$menu .= 
                    "<li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                <div class='mi-toggle'>
                    <span class='fldr'><i class='fa fa-folder'></i></span>
                    <span class='text'><a href='?directory=".self::removeFullPath($i->path)."'>".$i->name."</a></span>  
                    <span class='caretDown'><i class='fa fa-arrow-right'></i></span>
                </div>
                <ul class='nested'>"; 
                    self::isDirectoryReaderDos($i->items);
                    self::$menu .= "</ul></li>";
               }else{
                  // self::$menu .= "<li>".$i->name."</li>";
               }
        }
        return self::$menu;
    }

    public static function removeFullPath($string){
      return str_replace(public_path(), "", $string);
    }



}