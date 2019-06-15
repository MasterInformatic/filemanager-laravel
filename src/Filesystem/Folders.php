<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;

class Folders{

	public $name;
	public $type;
	public $path;
	public $items ;

	public function __construct($name,$type,$path,$items){
		$this->name=$name;
		$this->type=$type;
		$this->path=$path;
		$this->items=$items;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}
}