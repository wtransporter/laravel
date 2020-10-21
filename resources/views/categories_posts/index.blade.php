@extends('layout.app')

@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Home</a></li>
	    <li class="breadcrumb-item active">{{ $categoryName }}</li>
	  </ol>
	</nav>
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
			<?php
				if (strpos($post->content,'</pre>')) {
					$length = strpos($post->content,'</pre>')+5;
				} elseif (strpos($post->content,'</code>')) {
					$length = strpos($post->content,'</code>')+7;
				} else {
					$length = strlen($post->content) < 300 ? strlen($post->content) : 300;
				}
			?>
			{!! substr($post->content,0,$length) !!}
		</p>
		@if(strlen($post->content)>$length+1)
			<div class="px-1">
				<a href="{{ $post->path() }}" class="btn btn-outline-primary btn-sm">Read more ...</a>
			</div>
		@endif
	</div>
	<div class="card-footer d-flex flex-row justify-content-between">
		<div class="px-1">
			<span class="badge badge-info">Author: {{ $post->owner->name }} created at: {{ formatedDate($post->created_at) }}</span>
			<p><span class="badge badge-primary"><span >{{ $categoryName }}</span></span>
			</p>
		</div>
		@if(Auth::check() && (isModerator() || (Auth::user()->id == $post->owner->id)))
			<div class="px-1">
				<a href="{{ $post->path().'/edit' }}" class="btn btn-outline-danger btn-sm">Edit</a>
			</div>
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
