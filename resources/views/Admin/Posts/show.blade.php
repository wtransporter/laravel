@extends('layout.app')

@section('content')

	<div class="card">
		<div class="card-header card-title">
			<span class="h5">{{ $post->title }}</span>
			<div class="float-right"><strong>Status </strong>
				<span class="badge badge-{{ $post->activated ? 'success' : 'danger' }}">
					{{ $post->activated ? 'Published' : 'Pending' }}
				</span> - Author: {{ $post->owner->name }}
			</div>
		</div>
		<div class="card-body">			
			<p class="card-text">{!! $post->content !!}</p>
		</div>
		@php

		@endphp

		@can('manage', $post)
		<div class="card-footer d-flex flex-row align-items-start">
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
	@foreach($post->comments as $comment)
	<div class="card">
		<div class="card-header card-title">
			<p>{{ $comment->content }}</p>
		</div>
	</div>
	@endforeach

@endsection