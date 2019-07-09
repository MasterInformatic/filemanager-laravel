<div class="main" id="mainHeaderFixed">
    <div class="elements">

            <button class="btnTestOsmara btnMain" id="btnMain" data-action="" data-url="">
                <i class="fa fa-bars"></i>
            </button>

        <div class="l">
            <div class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Google_Drive_logo.svg/245px-Google_Drive_logo.svg.png" alt="">
                <span>Drive</span>
            </div>
        </div>
         
        <div class="s">
            <div class="search">
                <span>
                    <i class="fa fa-search"></i>
                </span>
                <input type="text" >
            </div>
        </div>

        <div class="i">
            <div class="view">
                <button class="s" id="changeView">
                    <i class="fa fa-th fa-th-list"></i>
                </button>
            </div>
            <div class="info">
                <span>
                    <i class="fa fa-info"></i>
                </span>
            </div>
        </div>

    </div>
    <div class="root" style="background: #fff" id="mainRoot">
        <div class="root_path">
            <h4 id="rootPath">storage</h4>
        </div>
        <div class="root_actions">
            <div class="actions">
                <button class="btnTestOsmara" id="btnMkDir" data-path="{{ config('mifilemanager.directory') }}" data-copy="">
                    <i class="fa fa-folder"></i>
                    <span >+</span>
                </button> 
                {{-- <button class="btnTestOsmara" id="fileView" data-name="s">
                    <i class="fa fa-eye"></i>
                </button>  --}}
            </div>
        </div>
    </div>
</div>