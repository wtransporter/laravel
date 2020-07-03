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
		<h5 class="card-title">Role list</h5>
		<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Display Name</th>
					<th scope="col">Created At</th>
				</tr>
			</thead>
			<tbody>
			@forelse($roles as $role)
				<tr>
					<th class="align-middle" scope="row">{{ $role->id }}</th>
					<td class="align-middle">{{ $role->name }}</td>
					<td class="align-middle">{{ $role->label }}</td>
					<td class="align-middle">{{ formatedDate($role->created_at) }}</td>
				</tr>
			@empty
				<p class="alert alert-default">No roles defined !</p>
			@endforelse
			</tbody>
		</table>
	</div>
	@include('includes.btn_create', ['path' => '/admin/roles/create'])
</div>

@endsection