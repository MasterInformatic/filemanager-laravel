(function($) {

	this.MIFileManager = function() {

  }

  MIFileManager.init = function(){
	initMi();
  }

  function initMi(){
	getDataXhttp("?directory=/storage/");
  }
 
})(jQuery);

	var btnMkDir = $("#btnMkDir");
	var modalRename = $("#modalRename");
	var btnCloseModal = $("#btnCloseModal");
	var btnCancel = $("#btnCancel");
	var btnSave = $("#btnSave");
	var mkdirname = $("#mkdirname");
	var path_dir = "?directory=/storage/";
	var path_back = "";
 
  var ajax = new XMLHttpRequest();

	function getDataXhttp(path){
	  ajax.addEventListener("progress", pH, false);
	  ajax.addEventListener("load", cH, false);
	  ajax.addEventListener("error", eH, false);
	  ajax.addEventListener("abort", aH, false);
	  ajax.open("GET", "/filemanager/getfiles"+path); 
	  ajax.send();
	}
  

  function pH(event) {
	$("#shwfiles").text("Cargando...");
  }

  function cH(event) {
	$("#shwfiles").text("");
	if(event.target.status==200){
		  $("#shwfiles").append(event.target.response);
	}else{
	  $("#shwfiles").text("Error");
	}

	$(".gif").jqGifPreview();
  
  }

  function eH(event) {
	$("#shwfiles").text("");
  }

  function aH(event) {
	$("#shwfiles").text("");
  }

	function testOsmaraqlera(el){
	  var path = el.getAttribute("data-path");

	  btnMkDir.attr("data-path","?directory="+path);
	  path_dir = "?directory=/"+path;
 
	  getDataXhttp("?directory="+path);

	    var ph_dir = path_dir.replace("?directory=","");
		ph_dir = ph_dir.replace("\\","");
		ph_dir = ph_dir.split("/").join(" > ");
		$("#rootPath").text(ph_dir);
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

	  function chanbg(el){/*======*/
		for (var i = 0; i < $("div.mi-toggle a").length; i++) {
			  $("div.mi-toggle a")[i]
				.parentElement
				.parentElement
				.style
				.background = "#fff";
			}
			el.parentElement
				.parentElement
				.style
				.background = "#d5d5d5";
	  }

	function eventsListener(){
	  
	  //
	  $("div.mi-toggle a.side").click(function(e){
		e.preventDefault();
		getDataXhttp(e.target.getAttribute("href"));
		btnMkDir.attr("data-path",e.target.getAttribute("href"));
		path_dir  = e.target.getAttribute("href");
		chanbg(this);/*======*/

		var ph_dir = path_dir.replace("?directory=","");
		ph_dir = ph_dir.replace("\\","");
		ph_dir = ph_dir.split("/").join(" > ");
		$("#rootPath").text(ph_dir);


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
  
	  $("div.mi-toggle a.actions").click(function(e){
		  e.preventDefault();
		  $("#myModal").removeClass("h");

		  var ac = $("#btnMain").attr("data-action");
		  var fn = $("#btnMain").attr("data-url");
		  var p_to   = $(this).attr("href");
		  var p_from = btnMkDir.attr("data-path");

		  var formdata = new FormData();
		  var ajax = new XMLHttpRequest();

		  formdata.append("p_to", p_to);
		  formdata.append("p_from", p_from);
		  formdata.append("filename", fn);

		  ajax.addEventListener("load", function(event){
			if(event.target.status==200){
				if(ac=="move"){
			  		var ele = document.getElementById(fn);
			  		ele.parentNode.removeChild(ele);
			  	}
			}
		  }, false);

		  if(ac=="copy"){
		 	 ajax.open("POST", "/filemanager/copyfiles"); 
		  }else if(ac=="move"){
		 	 ajax.open("POST", "/filemanager/movefiles"); 
		  }

		  ajax.send(formdata);

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

function uploadFile(file_h=null) {
  
  var file = null;
  console.log(file_h);
  if(file_h == null){

	  file = droppedFiles[0];
  }else{

	  file = file_h;
  }
	console.log(file);
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
   getDataXhttp(path_dir);
   alert(JSON.parse(event.target.response).message);
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


function ckd(ele){
	var path = ele.getAttribute("data-url");
	returnFileUrl(path);
}
		
		function getUrlParam( paramName ) {
			var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
			var match = window.location.search.match( reParam );

			return ( match && match.length > 1 ) ? match[1] : null;
		}

		function returnFileUrl(url) {
			var funcNum = getUrlParam('CKEditorFuncNum');
			var fileUrl = url;
			window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl, function(){

				// Get the reference to a dialog window.
				var dialog = this.getDialog();
				// Check if this is the Image Properties dialog window.
				if ( dialog.getName() == 'image' ) {
					// Get the reference to a text field that stores the "alt" attribute.
					var element = dialog.getContentElement( 'info', 'txtAlt' );
					// Assign the new value.
					if ( element )
						element.setValue( 'MasterInformatic Image' );
				}

			});
			window.close();
		}