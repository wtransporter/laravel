@extends('layout.app')

@section('content')

<div class="container col-md-8 col-md-offset-2">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">{{ $post->title }}</h5>
			<p><strong>Status </strong>{{ $post->status ? 'Published' : 'Pending' }} - {{ $post->owner->name }}</p>
			<p class="card-text">{{ $post->content }}</p>
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
</div>

@endsection