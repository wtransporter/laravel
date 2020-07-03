@extends('layout.app')

@section('content')

<div class="container col-md-8 col-md-offset-2">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">{{ $ticket->title }}</h5>
			<p><strong>Status </strong>{{ $ticket->status ? 'Answered' : 'Pending' }} - {{ $ticket->owner->name }}</p>
			<p class="card-text">{{ $ticket->content }}</p>
		</div>
		@can('manage', $ticket)
		<div class="card-footer d-flex flex-row align-items-start">
			<div class="px-1">
			<a href="{{ $ticket->path().'/edit' }}" class="btn btn-outline-primary">Edit</a>
			</div>
			<div class="px-1">
			<form action="{{ $ticket->path() }}" method="POST">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-outline-danger">Delete</button>
			</form>
			</div>
		</div>
		@endcan
	</div>
</div>

<div class="container col-md-8 col-md-offset-2">
	<div class="card mb-1 mt-1 bg-white rounded">
			@foreach($ticket->comments as $comment)
			    <div class="card-body">
				    @if ($loop->first)
						<h5 class="cart-header text-primary pb-2">Ticket comments</h5>
				    @endif
					<p class="small badge badge-info"><strong>Posted by: </strong>{{ $comment->owner->name }}
						At: {{ formatedDate($comment->created_at) }}
					</p>
					<p class="card-text">{{ $comment->content }}</p>
				</div>
				@if (! $loop->last)
					<div class="dropdown-divider"></div>
				@endif
			@endforeach
	</div>
</div>
@php
//dd($ticket);
@endphp
@can('manage', $ticket)
<div class="container col-md-8 col-md-offset-2">
	<div class="shadow-sm p-3 mb-5 bg-white rounded">
		<form action="{{ URL('/comments/'.$ticket->slug) }}" method="POST">
			@csrf
			@foreach($errors->all() as $error)
				<p class="alert alert-danger rounded">{{ $error }}</p>
			@endforeach
			@if(session('status'))
				<p class="alert alert-success">{{ session('status') }}</p>
			@endif
				<legend>Reply</legend>
				<div class="bmd-form-group">
					<label for="content" class="bmd-label-static col-lg-12">Content</label>
					<div class="col-lg-12">
						<textarea name="content" id="content" class="form-control" rows="3" placeholder="Content"></textarea>
						<span class="form-text text-muted small">Feel free fo leave a comment!</span>
					</div>
				</div>
				<div class="bmd-form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<a href="/tickets" class="btn btn-secondary">Cancel</a>
						<button type="submit" class="btn btn-primary">SUBMIT</button>
					</div>
				</div>
		</form>
	</div>
</div>
@endcan

@endsection