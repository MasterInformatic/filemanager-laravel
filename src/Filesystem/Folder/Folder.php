<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem\Folder;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Exception;

class Folder{


	public function __construct(){

	}

	static function createDir($dir,$path){
		try {
			if(config('mifilemanager.accessControl.FOLDER_CREATE')){
				if(static::isValidName($dir)){//validName
			        if(!static::isExits(public_path($path)."/".$dir)){//
			    		if(File::isDirectory(public_path($path))){
				        	$s = File::makeDirectory(public_path($path)."/".$dir, 0777, true, true);
				    	}
			    	}else{
			    		throw new Exception("Folder already exists", 1);
			    	
			    	}
				}else{
					throw new Exception("Invalid Name Folder", 1);
				}
			}else{
				throw new Exception("Permise denied", 1);
			}

			if($s){
				return response()->json([
		    			"status"=>"success",
		    			"status_code"=>200,
		    			"message"=>"Folder successful created ",
		    		]);
			}
			return response()->json([
		    			"status"=>"error",
		    			"status_code"=>403,
		    			"message"=>"An problem ocurred creating folder '".$dir."'",
		    	]);
		} catch (Exception $e) {
			return response()->json([
		    			"status"=>"error",
		    			"status_code"=>403,
		    			"message"=>$e->getMessage(),
		    		]);
		}
	}

	static function isValidName($name){
		 return preg_match("/^[a-zA-Z]*$/", $name);
	}

	static function isExits($full_path){
		if(File::isDirectory($full_path)){
		    return true;
		}else{
		   	return false;
		}
	}
}