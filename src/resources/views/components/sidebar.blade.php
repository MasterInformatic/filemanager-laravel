<aside class="shFiles" id="shFiles">
    <section >

        <div class="osmm">
            <ul id="myUL">
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