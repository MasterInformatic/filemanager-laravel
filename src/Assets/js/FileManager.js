    var btnMkDir = $("#btnMkDir");
    var modalRename = $("#modalRename");
    var btnCloseModal = $("#btnCloseModal");
    var btnCancel = $("#btnCancel");
    var btnSave = $("#btnSave");
    var mkdirname = $("#mkdirname");

    var path_dir = "?directory=/storage/";



    function getData(path){
        $.get("/filemanager/getfiles"+path, function(data, status){
          $("#shwfiles").text("");
          $("#shwfiles").append(data);
        });
    }
    
    function sendMkDir(){
        var p = btnMkDir.attr("data-path");
        var v = mkdirname.val();
        var c = p+v;

        $.post( "/filemanager/mkdir", { d_path: p,d_name: v })
          .done(function( data ) {
            if(data.status=="success"){
              alert(data.message);
              modalRename.removeClass("show");
              location.reload();
            }else{
              alert(data.message);
            }
          });
    }

    eventsListener();

    function eventsListener(){
      
      $("div.mi-toggle a").click(function(e){
        e.preventDefault();
        getData(e.target.getAttribute("href"));
        btnMkDir.attr("data-path",e.target.getAttribute("href"));

        path_dir  = e.target.getAttribute("href");
      });

      btnMkDir.click(function(){
        modalRename.addClass("show");
        var p = btnMkDir.attr("data-path");
      });
      btnCloseModal.click(function(){
        modalRename.removeClass("show");
      });
      btnCancel.click(function(){
        modalRename.removeClass("show");
      });
      btnSave.click(function(){
        sendMkDir();
      });
    }


var upload_form = $("#asideContent");
var droppedFiles = false;

upload_form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
  })
  .on('dragover dragenter', function() {
    upload_form.addClass('is-dragover');
  })
  .on('dragleave dragend drop', function() {
    upload_form.removeClass('is-dragover');
  })
  .on('drop', function(e) {
    droppedFiles = e.originalEvent.dataTransfer.files;
    uploadFile();
  });


    function drag(ev) {
    }

    function allowDrop(ev) {
      ev.preventDefault();
    }

    function drop(ev) {
      ev.preventDefault();
    }

  
function _(el) {
  return document.getElementById(el);
}

function uploadFile() {

  var file = droppedFiles[0];
  var formdata = new FormData();
  var ajax = new XMLHttpRequest();

  readURL(file);

  formdata.append("upload", file);
  formdata.append("path_dir", path_dir);
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "/filemanager/upload"); 
  ajax.send(formdata);

}

function progressHandler(event) {
  _("prgv").style.width = "0%";
  _("item_uploaded").classList.add("showItemUp");

  _("loaded_n_total").innerHTML = "Uploaded " + humanFileSize(event.loaded,true) + " bytes of " + humanFileSize(event.total,true);
  var percent = (event.loaded / event.total) * 100;
  _("prgv").style.width = Math.round(percent)+"%";

  quitSt();
}

function quitSt(){
  setTimeout(function(){
    _("item_uploaded").classList.remove("showItemUp");
  },5000);
}

function completeHandler(event) {
   _("prgv").style.width = "100%";
   getData(path_dir);
}

function errorHandler(event) {
  _("status").innerHTML = "Upload Failed";

}

function abortHandler(event) {
  _("status").innerHTML = "Upload Aborted";
}

function humanFileSize(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if(Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si
        ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
        : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while(Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1)+' '+units[u];
}

function readURL(input) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#tmposmara').attr('src', e.target.result);
    }
    reader.readAsDataURL(input);
}