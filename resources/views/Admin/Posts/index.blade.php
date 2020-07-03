@extends('layout.app')

@section('content')

<div class="card">
	<div class="card-body">
		@foreach($errors->all() as $error)
			<p class="alert alert-danger">{{ $error }}</p>
		@endforeach
		@if(session('status'))
			<p class="alert alert-success">{{ session('status') }}</p>
		@endif
		<h5 class="card-title">Post list</h5>
		<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Content</th>
					<th scope="col">Status</th>
					<th scope="col"></th>
					<th scope="col">Created At</th>
				</tr>
			</thead>
			<tbody>
			@forelse($posts as $post)
				<tr>
					<th class="align-middle" scope="row">{{ $post->id }}</th>
					<td class="align-middle">{{ $post->title }}</td>
					<td class="align-middle">{{ $post->content }}</td>
					<td class="align-middle">
						<span class="badge badge-{{ $post->activated ? 'success' : 'danger' }}">{{ $post->activated ? 'Active' : 'Pending' }}</span>
						</td>
					<td class="align-middle">
	                    <form class="m-0" action="{{ $post->path() }}" method="post">
	                        @method('PATCH')
	                        @csrf

							<input class="align-middle" name="activated" type="checkbox" 
                                    onChange="this.form.submit()" {{ $post->activated ? 'checked' : '' }}>

						</form>
					</td>
					<td class="align-middle">{{ formatedDate($post->created_at) }}</td>
				</tr>
			@empty
				<p class="alert alert-default">No posts yet !</p>
			@endforelse
			</tbody>
		</table>
	</div>
	@include('includes.btn_create', ['path' => '/posts/create'])
</div>

@endsection