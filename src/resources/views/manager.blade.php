<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MasterInformatic File Manager</title>
    <link rel="stylesheet" href="{{ asset('css/FileManager.css') }}">
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
    

@include('manager::components.header')


<div class="container" >

    @yield('manager::FileManager')

</div>




<script>
    
    var el_className = 'item';
    var el_op_hidde = 'ul_h';
    var class_selected = 'selected';

    var el_op_file = document.getElementById('ul_file');
    var el_op_folder = document.getElementById('ul_folder');
    var allItems = document.querySelectorAll(".item");
    var el_btn_send = document.getElementById('btnSuccess');
    

    function getElementByClassName(e, className){
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
    }

    function addClickListener(className){
        document.addEventListener( "click", function(e) {
            var element = getElementByClassName(e,el_className);

            if(element){
                showFileOptions();
                removeClassSelected(allItems);
                element.classList.add(class_selected);
                addAttrToBtn(element);
            }else{
                removeClassSelected(allItems);
                showFolderOptions();
            }
        });

    }

    function addDblClickListener(className){
        document.addEventListener( "dblclick", function(e) {
            var element = getElementByClassName(e,el_className);

            if(element){
                showFileOptions();
                removeClassSelected(allItems);
                element.classList.add(class_selected);
                addAttrToBtn(element);
                send();
            }else{
                removeClassSelected(allItems);
                showFolderOptions();
            }
        });

    }

    function showFileOptions(){
        el_op_file.classList.remove(el_op_hidde);
        el_op_folder.classList.add(el_op_hidde);
    }

    function showFolderOptions(){
        el_op_folder.classList.remove(el_op_hidde);
        el_op_file.classList.add(el_op_hidde);
    }

    function removeClassSelected(els){
        for (var i = 0; i < els.length; i++) {
            els[i].classList.remove(class_selected)
        }
    }

    function addAttrToBtn(el){
        el_btn_send.setAttribute('data-url',el.getAttribute("data-url"));
    }

    function send(){
        var url = el_btn_send.getAttribute("data-url");
        returnFileUrl(url);
    }

    addClickListener('item');
    addDblClickListener('item');


</script>

</body>
</html>