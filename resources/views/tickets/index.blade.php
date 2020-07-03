@extends('layout.app')

@section('content')
<div class="card">
	<div class="card-body">
		@if(session('status'))
			<p class="alert alert-success">{{ session('status') }}</p>
		@endif
		<h5 class="card-title">Ticket list</h5>
		<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Status</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
			@forelse($tickets as $ticket)
				<tr>
					<th class="align-middle" scope="row">{{ $ticket->id }}</th>
					<td class="align-middle">{{ $ticket->title }}</td>
					<td class="align-middle">
						<span  class="badge badge-{{ $ticket->status ? 'success' : 'danger' }}">
							{{ $ticket->status ? 'Answered' : 'Pending' }}
						</span>
					</td>
					<td class="align-middle"><a href="/tickets/{{ $ticket->slug }}" class="btn btn-primary">Show</a></td>
				</tr>
			@empty
				<p class="alert alert-default">No tickets yet !</p>
			@endforelse
			</tbody>
		</table>
	</div>
</div>
@endsection