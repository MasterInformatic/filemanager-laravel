<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;

use MasterInformatic\filemanagerlaravel\Filesystem\Folders;
use MasterInformatic\filemanagerlaravel\Filesystem\Files;

class ScanDir
{   

    public $directorys ;
    public $path;
 
	static function scanDos($dir){

        $files = array();

        if(file_exists($dir)){
        
            foreach(scandir($dir) as $f) {
            
                if(!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }

                if(is_dir($dir . '/' . $f)) {

                    $files[] = new Folders($f,"folder",$dir.'/'.$f,self::scanDos($dir.'/'.$f));
                    
                }else {

                    $files[] = new Files($f,"file",$dir.'/'.$f,filesize($dir.'/'.$f));

                }
            }
        
        }

        return $files;
    }

    static function scanFiles(){

        if(isset($_GET["directory"])){
            $dir = public_path().$_GET["directory"];
        }else{
            $dir = config('mifilemanager.dir');
        }

        $files = array();

        if(file_exists($dir)){
        
            foreach(scandir($dir) as $f) {
            
                if(!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }

                if(!is_dir($dir . '/' . $f)) {
                     $files[] = new Files($f,"file",self::removeFullPath($dir).'/'.$f,filesize($dir.'/'.$f));
                }
            }
        }

        return $files;
    }

    public static function removeFullPath($string){
        return str_replace(public_path(), "", $string);
    }

}
