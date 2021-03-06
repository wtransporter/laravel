@extends('layout.app')


@section('content')

{{-- @include('partials.create_post_ticket',['title' => 'Create new Post !',
			'action' => '/posts',
			'description' => ''
			]) --}}

<div class="container col-md-8 col-md-offset-2">
	<div class="shadow-sm p-3 mb-5 bg-white rounded">
		<form method="POST" action="{{ $post->path() }}">
			@csrf
			@method('PATCH')
			@foreach($errors->all() as $error)
				<p class="alert alert-danger rounded">{{ $error }}</p>
			@endforeach
			@if(session('status'))
				<p class="alert alert-success">{{ session('status') }}</p>
			@endif
				<legend>Edit Post !</legend>

				<div class="bmd-form-group">
					<label for="title" class="bmd-label-static col-lg-12 col-form-label col-form-label-sm">Title</label>
					<div class="col-lg-12">
						<input name="title" type="text" id="title" class="form-control" placeholder="Title" value="{{ $post->title }}">
					</div>
				</div>
				<div class="bmd-form-group" v-pre>
					<label for="content" class="bmd-label-static col-lg-12">Content</label>
					<div class="col-lg-12">
						<textarea name="content" id="content" class="form-control" rows="30" placeholder="Content" wrap="hard">{{ $post->content }}</textarea>
					</div>
				</div>
				<div class="bmd-form-group">
					<label for="categories" class="bmd-label-static col-lg-12">Categories</label>
					<div class="col-lg-12">
						<select name="categories[]" id="category" class="form-control" multiple>
						@foreach($categories as $category)
							<option value="{{ $category->id }}"
								@if(in_array($category->name, $selectedCategories))
									selected="selected"
								@endif>
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
