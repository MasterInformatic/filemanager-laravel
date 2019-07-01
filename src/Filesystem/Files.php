<?php

namespace MasterInformatic\filemanagerlaravel\Filesystem;

class Files{

	public $name;
	public $type;
	public $path;
	public $size;
	public $icon;
	public $tname;

	public function __construct($name,$type,$path,$size,$icon,$tname,$thumb){
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

}
