<aside class="shFiles" id="shFiles">
    <section >

        <div class="osmm">
            <ul id="myUL">
              <li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
                        <div class='mi-toggle'>
                            <span class='fldr'><i class='fa fa-folder'></i></span>
                            <span class='text'><a href='?directory={{ config('mifilemanager.directory') }}' class="side"> {{ config('mifilemanager.directory') }} </a></span> 
                             <span class='caretDown'><i class='fa fa-arrow-right'></i></span> 
                        </div>
                        <ul class='nested'>
                    {!! $menu !!}
            </ul>
        </div>
      
    </section>
</aside>

 

<script>
  $('.t-ul').find('li').click(function(e){
    $('.t-ul').find('li').removeClass('active');
    $(this).addClass('active');
    e.stopPropagation();
  })
  $("li.no-a").click(function(e){
      $(this).children("ul").collapse('toggle');
      e.stopPropagation();
  } );
</script>