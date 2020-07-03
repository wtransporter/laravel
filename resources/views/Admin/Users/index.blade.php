@extends('layout.app')

@section('content')

<div class="card">
	<div class="card-body">
		@if(session('status'))
			<p class="alert alert-success">{{ session('status') }}</p>
		@endif
		<h5 class="card-title">User list</h5>
		<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Status</th>
					<th scope="col">Registered At</th>
				</tr>
			</thead>
			<tbody>
			@forelse($users as $user)
				<tr>
					<th class="align-middle" scope="row">{{ $user->id }}</th>
					<td class="align-middle">{{ $user->name }}</td>
					<td class="align-middle">{{ $user->email }}</td>
					<td class="align-middle">
						<span class="badge badge-{{ $user->status ? 'success' : 'danger' }}">{{ $user->status ? 'Active' : 'Inactive' }}
						</span>
					</td>
					<td class="align-middle">{{ formatedDate($user->created_at) }}</td>
				</tr>
			@empty
				<p class="alert alert-default">No Users yet !</p>
			@endforelse
			</tbody>
		</table>
	</div>
</div>

@endsection