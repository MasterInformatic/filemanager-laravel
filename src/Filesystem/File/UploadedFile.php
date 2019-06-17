<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem\File;

use MasterInformatic\filemanagerlaravel\Filesystem\ScanDir;
use Illuminate\Support\Facades\File as FacedeFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

class UploadedFile{ 

	public function __construct(){

	}

	static function isImage($file){
		$mime = $file->getClientMimeType();
		$mimeImages =  [
	        "image/jpeg",
	        "image/pjpeg",
	        "image/png" ,
	        "image/gif",
	        "image/svg+xml",
    	];
        if (in_array($mime, $mimeImages)){
            return true;
        }
        return false;
	}

	static function isAllowedFile($extension){
		$allowedExtensions = 
		Config::get('mifilemanager.filesConfig.allowedExtensions');
        if (in_array($extension, $allowedExtensions)){
            return true;
        }
        return false;
	}

	static function isDeniedFile($extension){
		$allowedExtensions = 
		Config::get('mifilemanager.filesConfig.deniedExtensions');
        if (in_array($extension, $allowedExtensions)){
            return true;
        }
        return false;
	}

	static function isAllowedImage($extension){
		$allowedExtensions = 
		Config::get('mifilemanager.imagesConfig.allowedExtensions');

        if (in_array(strtolower($extension), $allowedExtensions)){
            return true;
        }
        return false;
	} 

	static function isDeniedImage($extension){
		$allowedExtensions = 
		Config::get('mifilemanager.imagesConfig.deniedExtensions');
        if (in_array(strtolower($extension), $allowedExtensions)){
            return true;
        }
        return false;
	} 
}