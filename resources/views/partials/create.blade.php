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
				<legend>Creat new {{ $title }}</legend>

				<div class="bmd-form-group">
					<label for="name" class="bmd-label-static col-lg-12 col-form-label col-form-label-sm">Name</label>
					<div class="col-lg-12">
						<input name="name" type="text" id="name" class="form-control" placeholder="Name">
					</div>
				</div>
				<div class="bmd-form-group">
					<label for="label" class="bmd-label-static col-lg-12 col-form-label col-form-label-sm">Display name</label>
					<div class="col-lg-12">
						<input name="label" type="text" id="label" class="form-control" placeholder="Display name">
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