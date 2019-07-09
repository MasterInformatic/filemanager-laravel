<?php

namespace MasterInformatic\filemanagerlaravel\Http\Controllers;

use MasterInformatic\filemanagerlaravel\Filesystem\File\DeletedFile;
use MasterInformatic\filemanagerlaravel\Filesystem\Folder\Folder;
use MasterInformatic\filemanagerlaravel\Filesystem\File\File;
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

class FileManagerController extends Controller{   

    protected $file_location;

    function __construct(){
        $this->file_location = Config::get('mifilemanager.directory');
    }

    public function fmkdir(Request $request){
        $path = str_replace('?directory=', "", $request->d_path);
        $success = Folder::createDir("$request->d_name",$path);
        return $success;
    }

	public function browser(){

		return view('manager::files',[
            "images"=>ScanDir::scanFiles(),
            "menu" => Build::main(),
            "menuActions" => Build::mainActions(),
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


   
	public function upload(Request $request){ 
        return File::upload($request);
	}

    public function getIm($filename){
        $file = Storage::disk("local")->get("thumbs/".$filename);
        $response = Response::make($file, 200);
        $response->header("Content-Type", "image/png");
        return $response;
    }

    public function getPlayer($i){
        $mimeImages =  [
            "image/jpeg",
            "image/pjpeg",
            "image/png" ,
            "image/svg+xml",
        ];
        $mimeGif = ["image/gif"];
        $mimeVideo = ["video/mp4"];
  
        if (in_array($i->mime, $mimeGif)){
            return "<img src='".url('storage/thumbs/'.$i->name)."' width='100%' height='100%' draggable='false' data-gif='".url($i->path)."' class='gif'>";
        }else if(in_array($i->mime, $mimeImages)){
            return "<img src='".url($i->path)."' alt='' width='100%' height='100%' draggable='false' />";
        }else if(in_array($i->mime, $mimeVideo)){
            return "<video width='200px' height='200px'>
                      <source src='".url($i->path)."' type='video/mp4'>
                    </video>";
        }else{
            
            $ext = FacedeFile::extension($i->path);
            $img = Config::get('mifilemanager.file_urls_array.'.$ext);

            return "<img src='/".$img."' alt='' width='100%' height='100%' draggable='false' />";
        }

    }
  
    public function getfiles(){

        $items = '';
        $items2 = '';
        foreach (ScanDir::scanFiles() as $i) {

            if($i->type=='folder'){
                
                if(Config::get('mifilemanager.folderConfig.showInView')){
                    $items2 .= "<div class='item ".$i->type."' data-path='".$i->path."' ondblclick='testOsmaraqlera(this)'>
                        <div class='img'>
                            <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Folder_1_icon-72a7cf.svg/1024px-Folder_1_icon-72a7cf.svg.png' alt=''>
                        </div>
                        <div class='data'>
                            <span>
                                ".$i->name."
                            </span>
                            
                        </div>
                    </div>";
                }
                 
            }else{ 
                
                $items .= "<div class='item ".$i->type."' data-url='".url($i->path)."' data-name='".$i->name."' data-id='".$i->name."' draggable='true' ondragstart='drag(event)' id='".$i->name."' ondblclick='ckd(this)'>
                    <div class='img'>
                         ".$this->getPlayer($i)."
                    </div>
                    <div class='data'>
                        <span>
                            <div>
                                <i class='".$i->icon."'></i> 
                                <div class='span'>
                                    <span>".$i->name."</span>
                                </div>
                            </div>
                            <div class='size'>
                                <span>
                                    ".$i->size."
                                </span>
                            </div>
                        </span>
                    </div>
                </div>";
            }

        }

        return "<div class='item file da'><div class='data'><span><div><i class=''></i> <div class='span'><span>".trans('mifilemanager::mifm.mc-view-name')."</span></div></div><div class='size'><span>".trans('mifilemanager::mifm.mc-view-size')."</span></div></span></div></div>".$items."<div class='view_fldrs'>".$items2."</div>";

    }
 
    public function delete(Request $request){
        $path = str_replace("?directory=/", "", $request->path_dir);
        $path = str_replace('?directory=', "", $path);
        $path = File::removeslashes($path);
        $f_path = public_path($path."/".$request->name);

        if(DeletedFile::delete($f_path)){
            return response()->json([
                "status" => "success",
                "status_code" => 200,
                "message" => trans('mifilemanager::mifm.msg-file-d-scs')
            ],200);
        }

        return response()->json([
                "status" => "error",
                "status_code" => 404,
                "message" => trans('mifilemanager::mifm.error-file-404')
            ],404);
    }

    public function copyfiles(Request $request){

        $to = str_replace("?directory=\\", "", $request->p_to);
        $to = str_replace("?directory=", "", $to);
        $to = $to."/".$request->filename;

        $from = str_replace("?directory=\\", "", $request->p_from);
        $from = str_replace("?directory=", "", $from);
        $from = $from."/".$request->filename;

        if($from == $to){
            return response()->json([
                "status" => "error",
                "status_code" => 403,
                "message" => trans('mifilemanager::mifm.error-mvcp-same')
            ],403);
        }
        try {
            FacedeFile::copy(public_path($from), public_path($to));
            return response()->json([
                "status" => "success",
                "status_code" => 200,
                "message" => trans('mifilemanager::mifm.msg-sccss-copy')
            ],200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "status_code" => 500,
                "message" => $e->getMessage()
            ],500);
        }
    }
 
    public function movefiles(Request $request){

        $to = str_replace("?directory=\\", "", $request->p_to);
        $to = str_replace("?directory=", "", $to);
        $to = $to."/".$request->filename;

        $from = str_replace("?directory=\\", "", $request->p_from);
        $from = str_replace("?directory=", "", $from);
        $from = $from."/".$request->filename;

        if($from == $to){
            return response()->json([
                "status" => "error",
                "status_code" => 403,
                "message" => trans('mifilemanager::mifm.error-mvcp-same')
            ],403);
        }

        try {
            FacedeFile::move(public_path($from), public_path($to));
            return response()->json([
                "status" => "success",
                "status_code" => 200,
                "message" => trans('mifilemanager::mifm.msg-sccss-move')
            ],200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "status_code" => 500,
                "message" => $e->getMessage()
            ],500);
        }
        
        
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
