@extends('layout.app')

@section('content')

<div class="card">
	<div class="card-header d-flex justify-content-between align-items-center">
		<div>
			<span class="card-title h5">Post list</span>
		</div>
		<div>
			<a href="/posts/create" class="btn btn-outline-primary">Create</a>
		</div>
	</div>
	<div class="card-body">
		@foreach($errors->all() as $error)
			<p class="alert alert-danger">{{ $error }}</p>
		@endforeach
		@if(session('status'))
			<p class="alert alert-success">{{ session('status') }}</p>
		@endif
		@php
			$isModerator = isModerator();
		@endphp
		<h5 class="card-title">Post list</h5>
		<div class="table-responsive">
			<table class="table table-sm">
				<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Content</th>
						<th scope="col">Status</th>
						<th scope="col"></th>
						<th scope="col">Created At</th>
						<th scope="col">Author</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
				@forelse($posts as $post)
					<tr>
						<th class="align-middle" scope="row">{{ $post->id }}</th>
						<td class="align-middle">{{ $post->title }}</td>
						<td class="align-middle">{{ Str::limit($post->content,50) }}</td>
						{{-- <td class="align-middle">
							<span class="badge badge-{{ $post->activated ? 'success' : 'danger' }}">{{ $post->activated ? 'Active' : 'Pending' }}</span>
						</td> --}}
						<td class="align-middle">
		                    @if($isModerator)
								<toggle-status :data="{{ $post }}"></toggle-status>
							@endif
						</td>
						<td class="align-middle">{{ formatedDate($post->created_at) }}</td>
						<td class="align-middle">{{ $post->owner->name }}</td>
						<td class="align-middle"><a href="/posts/{{ $post->slug }}" class="btn btn-primary">Show</a></td>
					</tr>
				@empty
					<p class="alert alert-default">No posts yet !</p>
				@endforelse
				</tbody>
			</table>
		</div>
		{{ $posts->links() }}
	</div>
	{{-- @include('includes.btn_create', ['path' => 'posts/create']) --}}
</div>

@endsection