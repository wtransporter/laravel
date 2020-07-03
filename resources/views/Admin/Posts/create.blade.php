@extends('layout.app')

@section('content')

@include('partials.create_post_ticket',['title' => 'Create new Post !',
			'action' => '/posts',
			'description' => ''
			])

@endsection