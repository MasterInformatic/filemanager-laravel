<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;

use MasterInformatic\filemanagerlaravel\Filesystem\ScanDir;

class Build extends ScanDir{ 

  public static $menu;
  public static $menuAction;

  public static function main(){ 
    $response = self::scanDos(config('mifilemanager.dir'));
    return self::isDirectoryReaderDos($response);
  }


  public static function isDirectoryReaderDos($items){
 
        foreach ($items as $i) {
               if($i->type=="folder"){
                    if(self::countFolders($i->items)==0){
                        self::$menu .= 
                            "<li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory=".self::removeFullPath($i->path)."' class='side'>".$i->name."</a></span>  
                        </div>
                        <ul class='nested'>"; 
                    }else{
                        self::$menu .= 
                            "<li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory=".self::removeFullPath($i->path)."' class='side'>".$i->name."</a></span>  
                            <span class='caretDown'><i class='fa fa-arrow-right'></i></span>
                        </div>
                        <ul class='nested'>"; 
                    }

                    self::isDirectoryReaderDos($i->items);
                    self::$menu .= "</ul></li>";
               }
        }
        return self::$menu;
    } 

public static function mainActions(){ 
    $response = self::scanDos(config('mifilemanager.dir'));
    return self::isDirectoryReaderDosActions($response);
}

 public static function isDirectoryReaderDosActions($items){
 
        foreach ($items as $i) {
               if($i->type=="folder"){
                    if(self::countFolders($i->items)==0){
                        self::$menuAction .= 
                            "<li >
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory=".self::removeFullPath($i->path)."' class='actions'>".$i->name."</a></span>  
                        </div>
                        <ul class='nested'>"; 
                    }else{
                        self::$menuAction .= 
                            "<li >
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory=".self::removeFullPath($i->path)."' class='actions'>".$i->name."</a></span>  
                            <span class='caretDown'><i class='fa fa-arrow-right'></i></span>
                        </div>
                        <ul class='nested'>"; 
                    }

                    self::isDirectoryReaderDos($i->items);
                    self::$menuAction .= "</ul></li>";
               }
        }
        return self::$menuAction;
    }

    static function countFolders($items){
        $var = 0;
        foreach ($items as $i) {
            if($i->type=="folder"){
                $var++;
            }
        }
        return $var;
    }

    static function countFiles($items){
        $var = 0;
        foreach ($items as $i) {
            if($i->type=="file"){
                $var++;
            }
        }
        return $var;
    }

    public static function removeFullPath($string){
      return str_replace(public_path(), "", $string);
    }

}