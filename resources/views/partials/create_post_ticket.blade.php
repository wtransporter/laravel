<div class="container col-md-8 col-md-offset-2">
	<div class="shadow-sm p-3 mb-5 bg-white rounded">
		<form method="POST" action="{{ $action }}">
			@csrf
			@foreach($errors->all() as $error)
				<p class="alert alert-danger rounded">{{ $error }}</p>
			@endforeach
			@if(session('status'))
				<p class="alert alert-success">{{ session('status') }}</p>
			@endif
				<legend>{{ $title }}</legend>

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
						<span class="form-text text-muted small">{{ $description }}</span>
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