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
		<h5 class="card-title">Categy list</h5>
		<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Created At</th>
				</tr>
			</thead>
			<tbody>
			@forelse($categories as $category)
				<tr>
					<th class="align-middle" scope="row">{{ $category->id }}</th>
					<td class="align-middle">{{ $category->name }}</td>
					<td class="align-middle">{{ formatedDate($category->created_at) }}</td>
				</tr>
			@empty
				<p class="alert alert-default">No categories defined !</p>
			@endforelse
			</tbody>
		</table>
	</div>
	@include('includes.btn_create', ['path' => '/admin/categories/create'])
</div>

@endsection