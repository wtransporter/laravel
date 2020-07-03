@extends('layout.app')

@section('content')

	@include('partials.create', ['title' => 'Ability',
					'action' => '/admin/abilities'])

@endsection