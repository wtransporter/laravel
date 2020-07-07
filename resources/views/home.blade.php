@extends('layout.app')

@section('content')

@foreach($errors->all() as $error)
	<p class="alert alert-danger">{{ $error }}</p>
@endforeach
@if(session('status'))
	<p class="alert alert-success">{{ session('status') }}</p>
@endif

@forelse($posts as $post)
<div class="card mt-2">
	<h5 class="card-header bg-light">{{ $post->title }}</h5>
	<div class="card-body">
		<p class="card-text">
			{!! $post->content !!}
		</p>
	</div>
	<div class="card-footer d-flex flex-row justify-content-between">
		<div class="px-1">
			<span class="badge badge-info">Author: {{ $post->owner->name }} created at: {{ formatedDate($post->created_at) }}</span>
			<p>@foreach($post->categories as $category) <a href="" class="badge badge-primary"><span >{{ $category->name }}</span></a>@endforeach</p>
		</div>
		@if(Auth::check())
			@if(Auth::user()->hasRole('moderator'))
			<div class="px-1">
				<a href="{{ $post->path().'/edit' }}" class="btn btn-outline-danger btn-sm">Edit</a>
			</div>
			@endif
		@endif
	</div>
</div>
@empty
	<p class="alert alert-default">No posts yet !</p>
@endforelse

<div class="mt-2">
	{{ $posts->links() }}
</div>

@endsection
