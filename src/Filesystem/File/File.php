<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem\File;

class File{

	public $name;
	public $type;
	public $path;
	public $size;
	public $files;

	public function __construct($name,$type,$path,$size){
		$this->name=$name;
		$this->type=$type;
		$this->path=$path;
		$this->size=$size;
	}

	public function getFileName(){
		return $this->name;
	}

	public function isImage(){
		
	}

	public function isValidFile(){
		 
	}
}