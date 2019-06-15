{{-- <header>
    <nav>
        <ul id="ul_folder">
            <li>
                <form action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
                    <input type="file" name="upload" onchange="submit()" id="addBtn" style="display:none;">
                    <label for="addBtn" class="btn">
                        añadir
                    </label>
                </form>
            </li>
            <li>
                <button data-url="" >Carpeta nueva</button>
            </li>
            <li>
                <button data-url="" >Renombrar</button>
            </li>
             <li>
                <button data-url="" >Eliminar</button>
            </li>
        </ul>
        <ul class="ul_h" id="ul_file">
            <li>
                <button data-url="" id="btnSuccess" onclick="send()">Seleccionar</button>
            </li>
            <li>
                <button data-url="" >Renombrar</button>
            </li>
            <li>
                <button data-url="" >Descargar</button>
            </li>
             <li>
                <button data-url="" >Eliminar</button>
            </li>
        </ul>
    </nav>
</header> --}}

<div class="main" id="mainHeaderFixed">
    <div class="elements">

        <button class="btnTestOsmara btnMain" id="btnMain">
            <i class="fa fa-bars"></i>
        </button>

        <button class="btnTestOsmara ">
            <i class="fa fa-upload"></i>
            <span>Añadir</span>
        </button>

        <button class="btnTestOsmara " >
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
        </button>

    </div>
</div>



