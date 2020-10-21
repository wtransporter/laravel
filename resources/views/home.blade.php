@extends('layout.app')

@section('content')

@foreach($errors->all() as $error)
	<p class="alert alert-danger">{{ $error }}</p>
@endforeach
@if(session('status'))
	<p class="alert alert-success">{{ session('status') }}</p>
@endif
<div class="table-responsive">
<table class="table table-sm">
	<tbody>
@forelse($posts as $post)

{{-- <div class="card mt-2">
	<h5 class="card-header bg-light">{{ $post->title }}</h5>
	<div class="card-body">
		<p class="card-text">
			{!! substr($post->content,0,(strpos($post->content,'</pre>') == 0) ? 350 : strpos($post->content,'</pre>')+5) !!}
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
</div> --}}

	<tr>
		<td class="align-middle">
			<img class="avatar" style="width: 60px; height: 60px;" 
				src="{{ file_exists(public_path().'/images/'.$post->categories->random(1)->first()->name.'.png') ? 
					asset('images').'/'.$post->categories->random(1)->first()->name.'.png' :
					asset('images').'/Laravel.png'}}">
		</td>
		<td class="align-middle">
			<a style="text-decoration: none;" href="{{ $post->path() }}">
				{{ $post->title }}
			</a>
		</td>
		<td class="align-middle">
			{!! trim(substr($post->content,0,90)) !!}...
		</td>
		<td class="align-middle">
			@foreach($post->categories as $category)
				@php
					$primary = collect([1, 2, 3]);
					$info = collect([4, 5, 6]);
					$warning = collect([7, 8, 9]);
					if ($primary->contains($category->id)) {
						$color = 'primary';
					} elseif ($info->contains($category->id)) {
						$color = 'info';
					} elseif ($warning->contains($category->id)) {
						$color = 'warning';
					}
					 else {
						$color = 'danger';
					}
				@endphp
				<a class="badge badge-{{ $color }} rounded-pill" href="/categories/{{$category->name}}">
					<span>{{ $category->name }}</span>
				</a>
			@endforeach
		</td>
	</tr>

@empty
	<p class="alert alert-default">No posts yet !</p>
@endforelse
	</tbody>
</table>
</div>

<div class="mt-2">
	{{ $posts->withQueryString()->links() }}
</div>

@endsection
