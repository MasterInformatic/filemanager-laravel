<?php

namespace MasterInformatic\filemanagerlaravel\Http\Controllers;

use MasterInformatic\filemanagerlaravel\Filesystem\Folder\Folder;
use MasterInformatic\filemanagerlaravel\Models\ImageStorage;
use MasterInformatic\filemanagerlaravel\Filesystem\ScanDir;
use MasterInformatic\filemanagerlaravel\Filesystem\Build;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ImageUpload;


class FileManagerController extends Controller
{   

    protected $file_location;


    function __construct(){
        $this->file_location = Config::get('mifilemanager.directory');
    }

    public function fmkdir(Request $request){
        $path = str_replace('?directory=', "", $request->d_path);
        $success = Folder::createDir("$request->d_name",$path);
        return $success;
        // return response()->json(["status"=>"success","message"=>"bien"]);
    }

    //
	public function browser(){



        // $files = File::files(public_path()."/storage/");
        // $file_info = [];
        // $icon_array = Config::get('mifilemanager.file_icon_array');
        // $type_array = Config::get('mifilemanager.file_type_array');

        // foreach ($files as $file)
        // {
        //     $file_name = $file;
        //     $file_size = 1;
        //     $extension = strtolower(File::extension($file_name));
        //     if (array_key_exists($extension, $icon_array))
        //     {
        //         $icon = $icon_array[$extension];
        //         $type = $type_array[$extension];
        //     } else
        //     {
        //         $icon = "fa-file";
        //         $type= "File";
        //     }
        //     $file_created = filemtime($file);
        //     $file_type = '';
        //     $file_info[] = [
        //         'name'      => $file_name,
        //         'size'      => $file_size,
        //         'created'   => $file_created,
        //         'type'      => $file_type,
        //         'extension' => $extension,
        //         'icon'      => $icon,
        //         'type'      => $type,
        //     ];
        // }

		return view('manager::files',[
            "images"=>ScanDir::scanFiles(),
            "menu" => Build::main(),
        ]);


	}

    public function isDirectoryReaderDos($items){
        foreach ($items as $i) {
           if($i->type=="folder"){
                echo "<li>".$i->name."(".$i.")<ul>"; 
                $this->isDirectoryReaderDos($i->items);
                echo "</ul></li>";
           }else{
                // echo "<li>".$i->name."</li>";
           }
        }
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

    public function getfiles(){

        $items = '';
        foreach (ScanDir::scanFiles() as $i) {

            $items .= "<div class='item' data-url='".url($i->path)."' data-name='".$i->name."' data-id='".$i->name."' draggable='true' ondragstart='drag(event)' id='".$i->name."'>
                <div class='img'>
                    <img src='".url($i->path)."' alt='' width='250px' height='250px' draggable='false'>
                </div>
                <div class='data'>
                    <span>".$i->name."</span>
                    <br>
                    <span>".$i->size."</span>
                </div>
                <div class='select'>
                    <div class='con'>
                       <div class='triangle'></div>
                        <img src='https://cdn2.iconfinder.com/data/icons/check-mark-style-1/1052/check_mark_voting_yes_no_20-512.png' alt=''>
                    </div>
                </div>
            </div>";
        }

        return $items;
    }

    public function copyfiles(Request $request){

        $file = str_replace(url("/"), "",$request->file_path);
        $file_name = $request->file_name;
        $to = $request->to_url;

       // $success = \File::copy(public_path()."/".$file,public_path()."/".$to."/".$file_name);

        return response()->json(true);
    }

    public function download(Request $request){
        return response()->download($request->file_path);
    }

    public function rename(){

        $file_oldname = '';
        $file_newname = '';

        $success = Storage::move($file_oldname, $file_newname); 
        if($success){
            Storage::delete($file_oldname);
        }

        return $file_newname;
    }
}
