<aside class="shFiles" id="shFiles">
    <section >


              <div class="t-subbody">
                <ul class="entry-meta clearfix t-ul">
                    
                  {!! $menu !!}

                </ul>
              </div>


</section>
</aside>



{{-- 
<section >
<div class="t-subbody">
                <ul class="entry-meta clearfix t-ul mi-main-fm">


                  <li class="no-a"> 
                    <div>
                        <span class="os">
                            <i class="fa fa-arrow-right"></i>
                            <a href="">menu-3.2</a>
                        </span>
                        <span class="mara">
                            <i class="fa fa-chevron-up"></i>
                        </span>
                    </div>
                    <ul class="t-ul collapse">


                      <li class="no-a">
                        <div>
                            <span class="os">
                                <i class="fa fa-arrow-right"></i>
                                <a href="">menu-3.2</a>
                            </span>
                            <span class="mara">
                                <i class="fa fa-chevron-up"></i>
                            </span>
                        </div>
                        <ul class="t-ul collapse">

                          <li class="no-a">
                            <div>
                                <span class="os">
                                    <i class="fa fa-arrow-right"></i>
                                    <a href="">menu-3.2</a>
                                </span>
                                <span class="mara">
                                    <i class="fa fa-chevron-up"></i>
                                </span>
                            </div>
                            <ul class="t-ul collapse">
                                
                              <li> menu-3.2.1.1 </li>
                              
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
</section> --}}



<script>
  $('.t-ul').find('li').click(function(e){
    $('.t-ul').find('li').removeClass('active');
    $(this).addClass('active');
    e.stopPropagation();
  })
  $("li.no-a").click(function(e){
      $(this).toggleClass('rev');
      $(this).children("ul").collapse('toggle');
      e.stopPropagation();
  } );
</script>