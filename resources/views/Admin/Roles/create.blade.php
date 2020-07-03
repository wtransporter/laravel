@extends('layout.app')

@section('content')

	@include('partials.create', ['title' => 'Role',
					'action' => '/admin/roles'])

@endsection