<header>
    <nav>
        <ul id="ul_folder">
            <li>
                {{-- <button data-url="" >Añadir</button> --}}
                <form action="{{ route('fmupload') }}" method="POST" enctype="multipart/form-data">
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
       {{--      <li>
                <button data-url="" id="btnSuccess" onclick="send()">Seleccionar</button>
            </li> --}}
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
</header>