<?php

namespace MasterInformatic\filemanagerlaravel\Models;

use Illuminate\Database\Eloquent\Model;

class ImageStorage extends Model
{
    protected $table = "images_storage";

    protected $fillable = [
        "name","url","size","thumb_url","type"
    ];

}


