<aside class="shFiles" id="shFiles">
    <section >

        <div class="osmm">
            <ul id="myUL">
              <li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory={{ config('mifilemanager.directory') }}' class="side"> {{ config('mifilemanager.directory') }} </a></span> 
                             <span class='caretDown'><i class='fa fa-angle-right'></i></span> 
                        </div>
                        <ul class='nested active'>
                    {!! $menu !!}
            </ul>
        </div>
      
    </section>
</aside>