<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem\File;

use MasterInformatic\filemanagerlaravel\Filesystem\ScanDir;
use Illuminate\Support\Facades\File as FacedeFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use ImageUpload;

class DeletedFile extends File{ 

	static function delete($path){
        if(static::fileExists($path)){
			FacedeFile::delete($path);
			return true;
		}
		return false;
	}

	
}