<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;

class Files{

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

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}
}