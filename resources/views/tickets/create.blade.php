@extends('layout.app')

@section('content')

@include('partials.create_post_ticket',['title' => 'Create new Ticket !',
			'action' => '/tickets',
			'description' => 'Feel free fo ask us any question!'
			])

@endsection