@extends('manager::ckeditor.manager')

@section('manager::ckeditor.FileManager')


	@foreach($images as $i)

	    <div class="item" data-url="{{ $i->url }}" >
	        <div class="img">
	            <img src="{{ $i->url }}" alt="" width="250px" height="250px">
	        </div>
	        <div class="data">
	            <span>{{ $i->name }}</span>
	            <br>
	            <span>{{ $i->created_at }}</span>
	        </div>
	        <div class="select">
	            <div class="con">
	               <div class="triangle"></div>
	                <img src="https://cdn2.iconfinder.com/data/icons/check-mark-style-1/1052/check_mark_voting_yes_no_20-512.png" alt="">
	            </div>
	        </div>
	    </div>


	@endforeach


@endsection