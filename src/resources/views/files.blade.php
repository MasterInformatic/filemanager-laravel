@extends('manager::manager')

@section('manager::FileManager')

<div id="shwfiles">
	
	@foreach($images as $i)

		@if($i->type=='folder')
			
			@if(config('mifilemanager.folderConfig.showInView'))
				<div class="item">
					<div class="img">
						<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Folder_1_icon-72a7cf.svg/1024px-Folder_1_icon-72a7cf.svg.png" alt="" idth="250px" height="250px">
					</div>
					<div class="data">
						<span>{{ $i->name }}</span>
					</div>
				</div>
			@endif

		@else

		    <div class="item" data-url="{{ url($i->getPath()) }}" data-name="{{ $i->getName() }}" data-id="{{ $i->getName() }}" draggable="true" ondragstart="drag(event)" id="{{ $i->getName() }}">
		        <div class="img">
		            <img src="{{ url($i->getPath()) }}" alt="" width="250px" height="250px" draggable="true">
		        </div>
		        <div class="data">
		            <span>{{ $i->getName() }}</span>
		            <br> 
		            <span>{{ $i->getSize() }}</span>
		            <span><i class="fa {{ $i->getTname() }}" ></i></span>
		        </div>
	{{-- 	        <div class="select">
		            <div class="con">
		               <div class="triangle"></div>
		                <img src="https://cdn2.iconfinder.com/data/icons/check-mark-style-1/1052/check_mark_voting_yes_no_20-512.png" alt="{{ $i->getName() }}">

		            </div>
		        </div> --}}
		    </div>
		@endif


	@endforeach

</div>
@endsection