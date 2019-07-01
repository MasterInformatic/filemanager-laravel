<?php

namespace MasterInformatic\filemanagerlaravel\Helpers;
  
 
class HumanizeFolders {

    public function isDirectoryReaderDos($items){
        foreach ($items as $i) {

           if($i->type=="folder"){
                echo "<li>".$i->name."<ul>"; 
                $this->isDirectoryReaderDos($i->items);
                echo "</ul></li>";
           }
           
        }
    }
}
