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
                    if(self::countFolders($i->items)==0){
                        self::$menu .= 
                            "<li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory=".self::removeFullPath($i->path)."'>".$i->name."(".self::countFiles($i->items).")</a></span>  
                        </div>
                        <ul class='nested'>"; 
                    }else{
                        self::$menu .= 
                            "<li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory=".self::removeFullPath($i->path)."'>".$i->name."(".self::countFiles($i->items).")</a></span>  
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