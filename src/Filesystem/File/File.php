<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem\File;
use Illuminate\Support\Facades\File as FacedeFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Exception;
use ImageUpload;

class File extends UploadedFile{

	public $name;
	public $type;
	public $path;
	public $size;
	public $icon;
	public $tname;
	public $thumb;
	public $mime;

	public function __construct($name,$type,$path,$size,$icon,$tname,$thumb,$mime=null){
		$this->name=$name;
		$this->type=$type;
		$this->path=$path;
		$this->size=$size;
		$this->size=$size;
		$this->icon=$icon;
		$this->tname=$tname;
		$this->thumb=$thumb;
		$this->mime=$mime;
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

	public function setThumb($thumb) { 
		$this->thumb = $thumb;
	}

	public function getThumb() { 
		return $this->thumb; 
	}

	static function isImageFile($path){
		$mime = FacedeFile::mimeType(public_path($path));
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
 	
	static function removeslashes($string){
		$string=implode("",explode("\\",$string));
		return stripslashes(trim($string));
	}

	static function fileExists($path){
		if(FacedeFile::exists($path)){
			return true;
		}
		return false;
	}

	static function upload($request){
		 
 		$file = $request->file('upload');
 		$path = str_replace('?directory=/', "", $request->path_dir);
 		$path = str_replace('?directory=', "", $path);
 		$path = static::removeslashes($path);

 		if(empty($path)){
 			$path = 'storage/';
 		}

 		try {
 		 	
        	$extension = $file->getClientOriginalExtension();
			//procesamiento de imagenes 
			if(static::isImage($file)){
				//isAllowededExtencion
				if(!static::isDeniedImage($extension) && static::isAllowedImage($extension)){
					$name = $file->getClientOriginalName();
					
					if ($file->getClientOriginalExtension() == 'gif') {

						$path = str_replace("storage", "", $path);
						$file->storeAs("public/".$path,$name);
						
        				if (!file_exists(public_path("storage/thumbs/"))) {
                            FacedeFile::makeDirectory(public_path("storage/thumbs/"), $mode = 0777, true, true);
                        }
						ImageUpload::make($file)->save("storage/thumbs/".$name);
					}else{
						ImageUpload::make($file)->save($path."/".$name);
					}
 					
				}else{
					throw new Exception(trans('mifilemanager::mifm.erro-file-di'), 1);
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
 		 		"message" => "upload success",
 		 		"uploaded" => 1,
                "fileName" => $name,
                "url" => url("storage/".$name)
 		 	],200);

 		 } catch (NotWritableException $e) {
 		 	return response()->json([
 		 		"status" => "error",
 		 		"status_code" => 500,
 		 		"message" => "No se pudo subir el archivo, verifique los permisos de su carpta"
 		 	],500);
 		 } catch (Exception $e) {
 		 	return response()->json([
 		 		"status" => "error",
 		 		"status_code" => 500,
 		 		"message" => $e->getMessage()
 		 	],500);
 		 } 

	}
}