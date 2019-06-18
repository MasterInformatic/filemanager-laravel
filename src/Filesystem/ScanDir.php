<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;


use MasterInformatic\filemanagerlaravel\Filesystem\File\File;
use MasterInformatic\filemanagerlaravel\Filesystem\Folder\Folder;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File as FacedeFile;

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
                    $extension = strtolower(FacedeFile::extension($f));

                    $files[] = new File(
                        $f,//name
                        "file",//type
                        $f,//path
                        static::humanizeSize(filesize($dir.'/'.$f)),//size
                        static::getIcon($extension),//icon
                        static::getFileType($extension)//type name
                    );
                    // dd($files[0]);

                }
            }
        
        }
        
        return $files;
    }

    static function getIcon($extension){
        $icon_array = Config::get('mifilemanager.file_icon_array');
        if (array_key_exists($extension, $icon_array)){
            $icon = $icon_array[$extension];
        }else{
            $icon = "fa-file";
        }
        return $icon;
    }
    static function getFileType($extension){
        $type_array = Config::get('mifilemanager.file_type_array');
        if (array_key_exists($extension, $type_array)){
            $type = $type_array[$extension];
        }else{
            $type= "File";
        }
        return $type;
    }



    static function scanFiles(){

        if(isset($_GET["directory"])){
            $dir = public_path($_GET["directory"]);

        }else{
            $dir = config('mifilemanager.dir');
        }


        $files = array();

        if(file_exists($dir)){
        
            foreach(scandir($dir) as $f) {
            
                if(!$f || $f[0] == '.') {
                    continue; // Ignore hidden files
                }

                if(!is_dir($dir . '/' . $f)) {//es folder

                    $extension = strtolower(FacedeFile::extension($f));
                    
                    if(File::isImageFile(self::removeFullPath($dir).'/'.$f)){

                        $files[] = new File(
                            $f,//name
                            "file",//type
                            self::removeFullPath($dir).'/'.$f,//path
                            static::humanizeSize(filesize($dir.'/'.$f)),//size
                            static::getIcon($extension),//icon
                            static::getFileType($extension)//type name
                        );
                    }else{
                        
                        if(!Config::get('mifilemanager.filesConfig.showImagesOnly')){

                            $icons_url = 
                            Config::get('mifilemanager.file_urls_array.'.$extension);
                            if(empty($icons_url)){
                                $icons_url ="";
                            }

                            $files[] = new File(
                                $f,//name
                                "file",//type
                                $icons_url,//path
                                static::humanizeSize(filesize($dir.'/'.$f)),//size
                                static::getIcon($extension),//icon
                                static::getFileType($extension)//type name
                            );

                        }

                    }


                }else{
                    $files[] =  new Folder(
                        $f,
                        "folder",
                        self::removeFullPath($dir).'/'.$f,
                        self::scanDos($dir.'/'.$f)
                    );
                }
            }
        }


        return $files;
    }

    public static function removeFullPath($string){
        return str_replace(public_path(), "", $string);
    }


    static function humanizeSize($bytes, $decimals = 2) {
        $size = array(' B',' kB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

}
