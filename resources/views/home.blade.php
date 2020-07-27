@extends('layout.app')

@section('content')

@foreach($errors->all() as $error)
	<p class="alert alert-danger">{{ $error }}</p>
@endforeach
@if(session('status'))
	<p class="alert alert-success">{{ session('status') }}</p>
@endif

{{-- @php
	$isModerator = false;
@endphp
@if(Auth::check())
	@foreach(Auth::user()->roles as $role)
		@if($role->name == 'moderator')
			@php
				$isModerator = true;
				break;
			@endphp
		@endif
	@endforeach
@endif --}}

@forelse($posts as $post)
<div class="card mt-2">
	<h5 class="card-header bg-light">{{ $post->title }}</h5>
	<div class="card-body">
		<p class="card-text">
			{!! substr($post->content,0,strpos($post->content,'</pre>')+5) !!}
		</p>
		@if(strlen($post->content)>strpos($post->content,'</pre>')+6)
			<div class="px-1">
				<a href="{{ $post->path() }}" class="btn btn-outline-primary btn-sm">Read more ...</a>
			</div>
		@endif
	</div>
	<div class="card-footer d-flex flex-row justify-content-between">
		<div class="px-1">
			<span class="badge badge-info">Author: {{ $post->owner->name }} created at: {{ formatedDate($post->created_at) }}</span>
			<p>@foreach($post->categories as $category) <a href="/categories/{{$category->name}}" class="badge badge-primary"><span >{{ $category->name }}</span></a>@endforeach</p>
		</div>
		@if(Auth::check() && (isModerator() || (Auth::user()->id == $post->owner->id)))
			<div class="px-1">
				<a href="{{ $post->path().'/edit' }}" class="btn btn-outline-danger btn-sm">Edit</a>
			</div>
		@endcan
	</div>
</div>
@empty
	<p class="alert alert-default">No posts yet !</p>
@endforelse

<div class="mt-2">
	{{ $posts->links() }}
</div>

@endsection
