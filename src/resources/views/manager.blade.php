<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<title>MasterInformatic File Manager</title>

		<link rel="stylesheet" href="{{ asset('FileManager/css/FileManager.css') }}">
		<link rel="stylesheet" href="{{ asset('FileManager/css/cropper.min.css') }}">
		<link rel="stylesheet" href="{{ asset('FileManager/css/dropzone.css') }}">
		<link rel="stylesheet" href="{{ asset('FileManager/css/gifplayer.css') }}">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="{{ asset('FileManager/js/cropper.js') }}"></script>
		<script src="{{ asset('FileManager/js/download.js') }}"></script>
		<script src="{{ asset('FileManager/js/dropzone.js') }}"></script>

		<script src="{{ asset('FileManager/js/jquery.gifplayer.js') }}"></script>
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
			<div id="status"></div>
			@yield('manager::FileManager')
	
</div>
@include('manager::components.modals.dirs')

		<script src="{{ asset('FileManager/js/FileManager.js') }}"></script>
		<script>
			MIFileManager.init();
		</script>

		<script>
		var toggler = document.getElementsByClassName("caretDown");
		var i;

		for (i = 0; i < toggler.length; i++) {
			toggler[i].addEventListener("click", function() {

				this.parentElement
					.querySelector(".fldr")
					.querySelector(".fa.fa-folder")
					.classList
					.toggle("fa-folder-open");

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
		$("#changeView").click(function(){
			$("#shwfiles").toggleClass("listView");
			$(this).children().toggleClass("fa-th-list");
		});
		</script>


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

	var menu2 = document.querySelector("#context-menu-2");
	var menuItems = menu2.querySelectorAll(".context-menu__item");
	var itemAll = menu2.querySelectorAll(".item");

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

			//si es archivo mostrar un meni
			if(taskItemInContext.classList.contains("file")){

				if ( taskItemInContext ) {

					e.preventDefault();
					toggleMenuOn();
					positionMenu(e);
				} else {
					taskItemInContext = null;
					toggleMenuOff();
				}
			}else{//si es carpeta mostrar otro menu
					taskItemInContext = null;
					toggleMenuOff();
			}

		});
	}


	function clickListener() {
		document.addEventListener( "click", function(e) {
			
			var elems = document.querySelectorAll(".item.select");
			[].forEach.call(elems, function(el) {
			    el.classList.remove("select");
			});

			var ql = clickInsideElement(e,"item");
			if(ql){
				var elemento = document.getElementById(ql.getAttribute("id"));
				if(elemento){
					elemento.classList.add("select");
				}
			}


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
	/*removeClass*/
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


		if(link.getAttribute("data-action")=="Copy"){
			$("#myModal").addClass("h");
			$("#btnMkDir").attr("data-copy",name);

			$("#btnMain").attr("data-action","copy");
			$("#btnMain").attr("data-url",name);

		}

		if(link.getAttribute("data-action")=="Move"){
			$("#myModal").addClass("h");
			$("#btnMkDir").attr("data-copy",name);
			$("#btnMain").attr("data-action","move");
			$("#btnMain").attr("data-url",name);
			
			
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
		var root = document.getElementById('mainRoot');

		btnMain.addEventListener('click',function(e){
				shFiles.classList.toggle('s');
				asideContent.classList.toggle('s');
				root.classList.toggle('s');
		});

</script>

</body>
</html>