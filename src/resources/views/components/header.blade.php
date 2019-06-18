<div class="main" id="mainHeaderFixed">
    <div class="elements">

        <button class="btnTestOsmara btnMain" id="btnMain">
            <i class="fa fa-bars"></i>
        </button>

        {{-- <button class="btnTestOsmara ">
             <i class="fa fa-upload"></i>
                <span>Añadir</span>

            <form action="" enctype="">
                <input type="file" id="upldFile" style="display: none;" onchange="uploadFile(this)">
                <label for="upldFile">
                    <i class="fa fa-upload"></i>
                    Añadir
                </label>
            </form>

        </button> --}}

        <button class="btnTestOsmara" id="btnMkDir" data-path="{{ config('mifilemanager.directory') }}">
            <i class="fa fa-folder"></i>
            <span >Crear Carpeta</span>
        </button>

       {{--  <button class="btnTestOsmara " >
            <i class="fa fa-eye"></i>
            <span>Ver</span>
        </button>

        <button class="btnTestOsmara ">
            <i class="fa fa-file-download"></i>
            <span>Descargar</span>
        </button>

        <button class="btnTestOsmara ">
            <i class="fa fa-copy"></i>
            <span>Copiar</span>
        </button>

        <button class="btnTestOsmara ">
            <i class="fa fa-file-export"></i>
            <span>Mover</span>
        </button>

        <button class="btnTestOsmara ">
            <i class="fa fa-edit"></i>
            <span>Renombrar</span>
        </button>

        <button class="btnTestOsmara ">
            <i class="fa fa-trash"></i>
            <span>Eliminar</span>
        </button> --}}

    </div>
</div> 
 
<script>
    async function SavePhoto(e) {

        let user = { name:'john', age:34 };
        let formData = new FormData();
        let photo = e.files[0];      
             
        formData.append("photo", photo);
        formData.append("user", JSON.stringify(user));  
        
        try {
           let r = await fetch('/upload/image', {method: "POST", body: formData}); 
           console.log('HTTP response code:',r.status); 
        } catch(e) {
           console.log('Huston we have problem...:', e);
        }
        
    }
</script>


