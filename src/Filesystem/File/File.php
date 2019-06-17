<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File as FacedeFile;
use Exception;

class File extends UploadedFile{

	public $name;
	public $type;
	public $path;
	public $size;
	public $icon;
	public $tname;

	public function __construct($name,$type,$path,$size,$icon,$tname){
		$this->name=$name;
		$this->type=$type;
		$this->path=$path;
		$this->size=$size;
		$this->size=$size;
		$this->icon=$icon;
		$this->tname=$tname;
	}


	public function setName($name) { 
		$this->name = $name;
	}

	public function getName() { 
		return $this->name; 
	}

	public function setType($type) { 
		$this->type = $type;
	}

	public function getType() { 
		return $this->type; 
	}

	public function setPath($path) { 
		$this->path = $path;
	}

	public function getPath() { 
		return $this->path; 
	}

	public function setSize($size) { 
		$this->size = $size; 
	}

	public function getSize() { 
		return $this->size; 
	}
	public function setIcon($icon) { 
		$this->icon = $icon; 
	}

	public function getIcon() { 
		return $this->icon; 
	}

	public function setTname($tname) { 
		$this->tname = $tname;
	}

	public function getTname() { 
		return $this->tname; 
	}

	static function upload($request){
		
 		$file = $request->file('upload');

 		try {
 		 	$path = str_replace('?directory=/', "", $request->path_dir);
        	$extension = $file->getClientOriginalExtension();
			//procesamiento de imagenes 
			if(static::isImage($file)){
				//isAllowededExtencion
				if(!static::isDeniedImage($extension) && static::isAllowedImage($extension)){
					$name = $file->getClientOriginalName();
					ImageUpload::make($file)->save($path."/".$name);
				}else{
					throw new Exception("Invalid Image or Denied Image", 1);
				}
			}else{
				//isAllowedFile
				if(!static::isDeniedFile($extension) && 
					static::isAllowedFile($extension)){
					$name = $file->getClientOriginalName();
	                $file->move($path,$name); 
				}else{
					throw new Exception("Invalid File or Denied File", 1);
				}
			} 
			return response()->json([
 		 		"status" => "success",
 		 		"status_code" => 200,
 		 		"message" => "upload success"
 		 	],200);
 		 } catch (Exception $e) {
 		 	return response()->json([
 		 		"status" => "error",
 		 		"status_code" => 200,
 		 		"message" => $e->getMessage() 
 		 	],200);
 		 } 

	}
}