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
                "<li class='no-a' ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'><div >
                        <span class='os'>
                            <i class='fa fa-arrow-right'></i>
                            <a href='?directory=".self::removeFullPath($i->path)."'>".$i->name."</a>
                        </span>
                    </div><ul class='t-ul collapse'>"; 
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