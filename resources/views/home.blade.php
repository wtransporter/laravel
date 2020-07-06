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
	<div class="card-footer d-flex flex-row align-items-start">
		<div class="px-1">
			<span class="badge badge-info">Author: {{ $post->owner->name }} created at: {{ formatedDate($post->created_at) }}</span>
			<p>@foreach($post->categories as $category) <span class="badge badge-primary">{{ $category->name }}</span> @endforeach</p>
		</div>
	</div>
</div>
@empty
	<p class="alert alert-default">No posts yet !</p>
@endforelse

<div class="mt-2">
	{{ $posts->links() }}
</div>

@endsection
