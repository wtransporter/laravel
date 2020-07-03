@extends('layout.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<div class="card mt-2">
				  <i class="mdi-editor-border-color"></i> <h5 class="card-header">Manage User</h5>
				  <div class="card-body">
				    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				    <a href="/admin/users" class="btn btn-raised btn-primary">All Users</a>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mt-2">
				  <h5 class="card-header">Manage Roles</h5>
				  <div class="card-body">
				    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				    <a href="/admin/roles" class="btn btn-primary">All Roles</a>
				    <a href="/admin/roles/create" class="btn btn-primary">Create a Role</a>
				  </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card mt-2">
				  <h5 class="card-header">Manage Abilities</h5>
				  <div class="card-body">
				    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				    <a href="/admin/abilities" class="btn btn-primary">All Abilities</a>
				    <a href="/admin/abilities/create" class="btn btn-primary">Create Ability</a>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mt-2">
				  <h5 class="card-header">Manage Tickets</h5>
				  <div class="card-body">
				    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				    <a href="/tickets" class="btn btn-primary">All Tickets</a>
				  </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card mt-2">
				  <h5 class="card-header">Manage Posts</h5>
				  <div class="card-body">
				    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				    <a href="/posts" class="btn btn-primary">All Posts</a>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mt-2">
				  <h5 class="card-header">Manage Categories</h5>
				  <div class="card-body">
				    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				    <a href="/admin/categories" class="btn btn-primary">All Categories</a>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection