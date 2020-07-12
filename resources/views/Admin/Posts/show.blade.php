@extends('layout.app')

@section('content')

	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Home</a></li>
	    <li class="breadcrumb-item active">{{ $post->title }}</li>
	  </ol>
	</nav>
	<div class="card">
		<div class="card-header card-title">
			<span class="h5">{{ $post->title }}</span>
			@if(Auth::check() && Auth()->user()->hasRole('moderator'))
				<div class="float-right"><strong>Status </strong>
					<span class="badge badge-{{ $post->activated ? 'success' : 'danger' }}">
						{{ $post->activated ? 'Published' : 'Pending' }}
					</span> - Author: {{ $post->owner->name }}
				</div>
			@endif
		</div>
		<div class="card-body">			
			<p class="card-text">{!! $post->content !!}</p>
		</div>
		@php

		@endphp

		<div class="card-footer d-flex flex-row">			
			<div class="col-lg-10">
				<span class="badge badge-info">Author: {{ $post->owner->name }} created at: {{ formatedDate($post->created_at) }}</span>
				<p>@foreach($post->categories as $category) <a href="" class="badge badge-primary"><span >{{ $category->name }}</span></a>@endforeach</p>
			</div>
			@can('manage', $post)
				<div class="col-lg-2 d-flex justify-content-between">
					<div class="px-1">
					<a href="{{ $post->path().'/edit' }}" class="btn btn-outline-primary">Edit</a>
					</div>
					<div class="px-1">
					<form action="{{ $post->path() }}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-outline-danger">Delete</button>
					</form>
					</div>
				</div>
			@endcan
		</div> 
	</div>
	@foreach($post->comments as $comment)
	<div class="card">
		<div class="card-header card-title">
			<p>{{ $comment->content }}</p>
		</div>
	</div>
	@endforeach

@endsection