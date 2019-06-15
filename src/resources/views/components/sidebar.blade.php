<aside class="shFiles" id="shFiles">
    <section >


              <div class="t-subbody">
                <ul class="entry-meta clearfix t-ul">
                    
                  
                  <li class='no-a' ondrop='drop(event)' ondragover='allowDrop(event)' data-path="/"><div>
                        <span class='os'>
                            <i class='fa fa-arrow-right'></i>
                            <a href='?directory=/storage/'>Storage</a>
                        </span>
                    </div><ul class='t-ul collapse'>
                      {!! $menu !!}
                    </ul></li>

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
      // $(this).toggleClass('rev');
      $(this).children("ul").collapse('toggle');
      e.stopPropagation();
  } );
</script>