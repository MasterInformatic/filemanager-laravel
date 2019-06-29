<?php

namespace MasterInformatic\filemanagerlaravel\Http\Controllers;

use MasterInformatic\filemanagerlaravel\Filesystem\File\DeletedFile;
use MasterInformatic\filemanagerlaravel\Filesystem\Folder\Folder;
use MasterInformatic\filemanagerlaravel\Filesystem\File\File;
use MasterInformatic\filemanagerlaravel\Models\ImageStorage;
use MasterInformatic\filemanagerlaravel\Filesystem\ScanDir;
use MasterInformatic\filemanagerlaravel\Filesystem\Build;
use Illuminate\Support\Facades\File as FacedeFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ImageUpload;
use Response;


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
    }

    //
	public function browser(){

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
        return File::upload($request);
	}

    public function getIm($filename){
        $file = Storage::disk("local")->get("thumbs/".$filename);
        $response = Response::make($file, 200);
        $response->header("Content-Type", "image/png");
        return $response;
    }

    public function getfiles(){
        $items = '';
        foreach (ScanDir::scanFiles() as $i) {

            if($i->type=='folder'){

                if(Config::get('mifilemanager.folderConfig.showInView')){
                    $items .= "<div class='item' data-path='".$i->path."' ondblclick='testOsmaraqlera(this)'>
                        <div class='img'>
                            <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Folder_1_icon-72a7cf.svg/1024px-Folder_1_icon-72a7cf.svg.png' alt='' idth='250px' height='250px'>
                        </div>
                        <div class='data'>
                            <span>".$i->name."</span>
                        </div>
                    </div>";
                }
                 
            }else{
                
                if(strtolower(FacedeFile::extension($i->path)) == "gif"){
                    $path_ = "
                      <img src='".url('storage/thumbs/'.$i->name)."' width='250px' height='250px' draggable='false' data-gif='".url($i->path)."' class='gif'>";
                }else{
                    $path_ = "<img src='".url($i->path)."' alt='' width='250px' height='250px' draggable='false' />";
                }

                $items .= "<div class='item' data-url='".url($i->path)."' data-name='".$i->name."' data-id='".$i->name."' draggable='true' ondragstart='drag(event)' id='".$i->name."' ondblclick='ckd(this)'>
                    <div class='img'>
                         $path_
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

        }

        return $items;

    }
 
    public function delete(Request $request){
        $path = str_replace("?directory=/", "", $request->path_dir);
        $path = str_replace('?directory=', "", $path);
        $path = File::removeslashes($path);
        $f_path = public_path($path."/".$request->name);

        // dd($f_path);
        if(DeletedFile::delete($f_path)){
            return response()->json([
                "status" => "success",
                "status_code" => 200,
                "message" => "File deleted successful"
            ],200);
        }

        return response()->json([
                "status" => "error",
                "status_code" => 404,
                "message" => "File not found"
            ],404);
    }

    public function copyfiles(Request $request){
        $file = str_replace(url("/"), "",$request->file_path);
        $file_name = $request->file_name;
        $to = $request->to_url;
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
