<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<title>MasterInformatic File Manager</title>

		<link rel="stylesheet" href="{{ asset('FileManager/css/FileManager.css') }}">
		<link rel="stylesheet" href="{{ asset('FileManager/css/cropper.min.css') }}">
		<link rel="stylesheet" href="{{ asset('FileManager/css/dropzone.css') }}">

		<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="{{ asset('FileManager/js/cropper.js') }}"></script>
		<script src="{{ asset('FileManager/js/download.js') }}"></script>
		<script src="{{ asset('FileManager/js/dropzone.js') }}"></script>

</head>
<body>
		
@include('manager::components.header')
 
@include('manager::components.sidebar')

@include('manager::components.menu')

@include('manager::components.modals.mkdir')

<div class="container" id="asideContent" ondrop='drop(event)' ondragover='allowDrop(event)' >
		
			<div class="item_uploaded" id="item_uploaded">
				<div class="thumb">
					<img src="" alt="" id="tmposmara">
				</div>
				<div class="data-upload">
					<div class="bar">
						<div class="prg" id="prg">
							<div class="prgv" id="prgv" ></div>
						</div>
					</div>
					<div class="progress">
							<p id="loaded_n_total"></p>
					</div>
				</div>
			</div>

			@yield('manager::FileManager')
	
</div>




<script src="{{ asset('FileManager/js/FileManager.js') }}"></script>
<script>
	MIFileManager.init();
</script>





		<script>
		var toggler = document.getElementsByClassName("caretDown");
		var i;

		for (i = 0; i < toggler.length; i++) {
			toggler[i].addEventListener("click", function() {

						console.log(this);

				this.parentElement
						.parentElement
						.querySelector(".nested")
						.classList
						.toggle("active");

				this.querySelector(".fa")
						.classList
						.toggle("rt");

			});
		}
		</script>

 

{{-- <script>

		function drag(ev) {
			 ev.dataTransfer.setData("url", ev.target.getAttribute("data-url"));
			 ev.dataTransfer.setData("name", ev.target.getAttribute("data-id"));
			 ev.dataTransfer.effectAllowed = "copyMove";
		}

		function allowDrop(ev) {
			ev.preventDefault();
		}

		function drop(ev) {
			ev.preventDefault();

				var file_url = ev.dataTransfer.getData("url");
				var file_name = ev.dataTransfer.getData("name");

				var url = findAncestor(ev.target,'.no-a');
				url= url.getAttribute("data-path");

				$.post( "/filemanager/copyfiles", { file_path: file_url,file_name: file_name, to_url: url })
						.done(function( data ) {

				});

		}


		function findAncestor (el, sel) {
					while ((el = el.parentElement) && !((el.matches || el.matchesSelector).call(el,sel)));
					return el;
			}
</script> --}}


<script>
		(function() {
	
	"use strict";

	function clickInsideElement( e, className ) {
		var el = e.srcElement || e.target;
		
		if ( el.classList.contains(className) ) {
			return el;
		} else {
			while ( el = el.parentNode ) {
				if ( el.classList && el.classList.contains(className) ) {
					return el;
				}
			}
		}

		return false;
	}


	function getPosition(e) {
		var posx = 0;
		var posy = 0;

		if (!e) var e = window.event;
		
		if (e.pageX || e.pageY) {
			posx = e.pageX;
			posy = e.pageY;
		} else if (e.clientX || e.clientY) {
			posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
			posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		}

		return {
			x: posx,
			y: posy
		}
	}


	var contextItem = "item";
	var allItems = document.querySelectorAll(".item");

	var contextMenuClassName = "context-menu";
	var contextMenuItemClassName = "context-menu__item";
	var contextMenuLinkClassName = "context-menu__link";
	var contextMenuActive = "context-menu--active";

	var taskItemClassName = "item";
	var taskItemInContext;

	var clickCoords;
	var clickCoordsX;
	var clickCoordsY;

	var menu = document.querySelector("#context-menu");
	var menuItems = menu.querySelectorAll(".context-menu__item");
	var itemAll = menu.querySelectorAll(".item");

	var menuItems2 = document.querySelectorAll(".btnTestOsmara");

	var menuState = 0;
	var menuWidth;
	var menuHeight;
	var menuPosition;
	var menuPositionX;
	var menuPositionY;

	var windowWidth;
	var windowHeight;

	var modalRename = document.getElementById("modalRename");

	function loadItems(){
		allItems = document.querySelectorAll(".item");
	}

	function init() {
		contextListener();
		clickListener();
		keyupListener();
		resizeListener();
	}


	function contextListener() {
		document.addEventListener( "contextmenu", function(e) {
			taskItemInContext = clickInsideElement( e, taskItemClassName );

			// console.log(taskItemInContext);

			if ( taskItemInContext ) {

				e.preventDefault();
				toggleMenuOn();
				positionMenu(e);
			} else {
				taskItemInContext = null;
				toggleMenuOff();
			}
		});
	}


	function clickListener() {
		document.addEventListener( "click", function(e) {
			var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );
			

			if ( clickeElIsLink ) {
				e.preventDefault();
				menuItemListener( clickeElIsLink );
			} else {
				var button = e.which || e.button;
				if ( button === 1 ) {
					toggleMenuOff();
				}
			}
		});
	}

	function removeClass(els,className){
		console.log(els.length);
		for(var i=0;i < els.length; i++){
				els[i].classList.remove(className);
		}
	}

	/*ESC*/
	function keyupListener() {
		window.onkeyup = function(e) {
			if ( e.keyCode === 27 ) {
				toggleMenuOff();
			}
		}
	}

	/*RESIEZE*/
	function resizeListener() {
		window.onresize = function(e) {
			toggleMenuOff();
		};
	}

	/*mostrar menu*/
	function toggleMenuOn() {
		if ( menuState !== 1 ) {
			menuState = 1;
			menu.classList.add( contextMenuActive );
		}
	}

	/*ocultar menu*/
	function toggleMenuOff() {
		if ( menuState !== 0 ) {
			menuState = 0;
			menu.classList.remove( contextMenuActive );
		}
	}


	function positionMenu(e) {


		clickCoords = getPosition(e);
		clickCoordsX = clickCoords.x;
		clickCoordsY = clickCoords.y;
		

		menuWidth = menu.offsetWidth + 4;
		menuHeight = menu.offsetHeight + 4;

		windowWidth = window.innerWidth;
		windowHeight = window.innerHeight;

		console.log((windowHeight - clickCoordsY) );
		
		if ( (windowWidth - clickCoordsX) < menuWidth ) {
			menu.style.left = windowWidth - menuWidth + "px";
		} else {
			menu.style.left = clickCoordsX + "px";
		}


		if ( (windowHeight - clickCoordsY) < menuHeight ) {
			// menu.style.top = windowHeight - menuHeight + "px";
			menu.style.top = clickCoordsY + "px";
		} else {
			menu.style.top = clickCoordsY + "px";
		}
	}


	function menuItemListener( link ) {

		var url = taskItemInContext.getAttribute("data-url");
		var name = taskItemInContext.getAttribute("data-id");

		if(link.getAttribute("data-action")=="View"){
			window.open(url, '_blank');
		}

		if(link.getAttribute("data-action")=="Download"){
				var x=new XMLHttpRequest();
				x.open("GET", url, true);
				x.responseType = 'blob';
				x.onload=function(e){download(x.response, name, "image/jpeg" ); }
				x.send();
		}

		if(link.getAttribute("data-action")=="Delete"){
			    var formdata = new FormData();
			  	var ajax = new XMLHttpRequest();
			  	formdata.append("name", name);
			  	formdata.append("path_dir", path_dir);
			  	ajax.addEventListener("load", function(event){
			  		if(event.target.status==200){
			  			var ele = document.getElementById(name);
			  			ele.parentNode.removeChild(ele);
			  		}
			  	}, false);
			  	ajax.open("POST", "/filemanager/delete"); 
			  	ajax.send(formdata);
		}

		if(link.getAttribute("data-action")=="Select"){

		}

		toggleMenuOff();

	}

	

	init();

})();
</script>

<script>
		/*MENU ASIDE*/
		var btnMain = document.getElementById('btnMain');
		var shFiles = document.getElementById('shFiles');
		var asideContent = document.getElementById('asideContent');

		btnMain.addEventListener('click',function(e){
				shFiles.classList.toggle('s');
				asideContent.classList.toggle('s');
		});

</script>

</body>
</html>