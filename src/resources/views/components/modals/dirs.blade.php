<div class="mimodal" id="myModal">

	<div class="mimodal-d">
		
		<div class="mimodal-content">
			
			<div class="mm-header">
				<h4>Selecciona la carpeta</h4>
				<button class="" data-dimiss="myModal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="mm-body">
				<div class="osmm">
		            <ul id="myUL">
		              <li ondrop='drop(event)' ondragover='allowDrop(event)' data-path='".self::removeFullPath($i->path)."'>
		                        <div class='mi-toggle'>
		                            <span class='fldr'><i class='fa fa-folder'></i></span>
		                            <span class='text'><a href='?directory={{ config('mifilemanager.directory') }}' class="actions"> {{ config('mifilemanager.directory') }} </a></span> 
		                             <span class='caretDown'><i class='fa fa-arrow-right'></i></span> 
		                        </div>
		                        <ul class='nested'>
		                    {!! $menuActions !!}
		            </ul>
		        </div>
			</div>
		</div>

	</div>
</div>

<script>

	$("button").click(function(e){
		var m = $(this).attr("data-dimiss");
		$("#"+m).removeClass("h");
	});
	$("button").click(function(e){
		var m = $(this).attr("data-show");
		$("#"+m).addClass("h");
	});
</script>