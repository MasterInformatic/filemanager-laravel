@extends('manager::manager')

@section('manager::FileManager')

<div id="shwfiles">
	

	@foreach($images as $i)


	    <div class="item" data-url="{{ url($i->path) }}" data-name="{{ $i->name }}" data-id="{{ $i->name }}" draggable="true" ondragstart="drag(event)" id="{{ $i->name }}">
	        <div class="img">
	            <img src="{{ url($i->path) }}" alt="" width="250px" height="250px" draggable="false">
	        </div>
	        <div class="data">
	            <span>{{ $i->name }}</span>
	            <br>
	            <span>{{ $i->size }}</span>
	        </div>
	        <div class="select">
	            <div class="con">
	               <div class="triangle"></div>
	                <img src="https://cdn2.iconfinder.com/data/icons/check-mark-style-1/1052/check_mark_voting_yes_no_20-512.png" alt="">
	            </div>
	        </div>
	    </div>


	@endforeach

</div>
@endsection