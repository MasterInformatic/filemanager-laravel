<div class="main" id="mainHeaderFixed">
    <div class="elements">

        <button class="btnTestOsmara btnMain" id="btnMain">
            <i class="fa fa-bars"></i>
        </button>

        <button class="btnTestOsmara ">

            <form action="url('filemanager/upload')" enctype="">
                <input type="file" id="upldFile" style="display: none;" onchange="uploadFile(this)" name="upload">

                <label for="upldFile">
                    <i class="fa fa-upload"></i>
                    Añadir
                </label>

            </form>

        </button>
    
        <button class="btnTestOsmara" id="btnMkDir" data-path="{{ config('mifilemanager.directory') }}" data-copy="">
            <i class="fa fa-folder"></i>
            <span >{{ trans('mifilemanager::mifm.new-folder') }}</span>
        </button>


    </div>
</div>