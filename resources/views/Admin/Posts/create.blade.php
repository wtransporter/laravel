@extends('layout.app')

@section('content')

{{-- @include('partials.create_post_ticket',['title' => 'Create new Post !',
			'action' => '/posts',
			'description' => ''
			]) --}}

<div class="container col-md-8 col-md-offset-2">
	<div class="shadow-sm p-3 mb-5 bg-white rounded">
		<form method="POST" action="/posts">
			@csrf
			@foreach($errors->all() as $error)
				<p class="alert alert-danger rounded">{{ $error }}</p>
			@endforeach
			@if(session('status'))
				<p class="alert alert-success">{{ session('status') }}</p>
			@endif
				<legend>Create new Post !</legend>

				<div class="bmd-form-group">
					<label for="title" class="bmd-label-static col-lg-12 col-form-label col-form-label-sm">Title</label>
					<div class="col-lg-12">
						<input name="title" type="text" id="title" class="form-control" placeholder="Title">
					</div>
				</div>
				<div class="bmd-form-group">
					<label for="content" class="bmd-label-static col-lg-12">Content</label>
					<div class="col-lg-12">
						<textarea name="content" id="content" class="form-control" rows="3" placeholder="Content"></textarea>
					</div>
				</div>
				<div class="bmd-form-group">
					<label for="categories" class="bmd-label-static col-lg-12">Categories</label>
					<div class="col-lg-12">
						<select name="categories[]" id="category" class="form-control" multiple>
						@foreach($categories as $category)
							<option value="{{ $category->id }}">
								{{ $category->name }}
							</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="bmd-form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button class="btn btn-secondary">Cancel</button>
						<button type="submit" class="btn btn-primary">SUBMIT</button>
					</div>
				</div>
		</form>
	</div>
</div>

@endsection