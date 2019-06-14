<?php

namespace MasterInformatic\filemanagerlaravel\Http\Controllers;

use MasterInformatic\filemanagerlaravel\Models\ImageStorage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ImageUpload;

class FileManagerController extends Controller
{
    //
	public function browser(){

		$images = ImageStorage::all();  
		return view('manager::files',[
            "images"=>$images,
        ]);

	}

	public function browser_ckeditor(){
		$images = ImageStorage::all();  
		return view('manager::ckeditor.files',[
            "images"=>$images,
        ]);
	}


	public function upload(Request $request){

		$file = $request->file('upload');


		$name = "img_".uniqid().".png";
            $file = $request->file('upload');

            ImageUpload::make($file)->save('storage/'.$name);

            ImageStorage::create([
                "name" => $name,
                "url"  => "http://masterinformatic2.0.mi/storage/".$name,
                "size" => $file->getClientSize(),
                "thumb_url" => "http://masterinformatic2.0.mi/storage/".$name,
                "type" => $file->getClientMimeType()
            ]);

           	return back();
	}

	public function upload_ckeditor(){

	}
}
