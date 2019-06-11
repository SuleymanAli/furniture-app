@extends('layout.admin')

@section('content')
<div class="col-md-8 mx-auto">
	<h1>Categories</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>#</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach($categories as $category)
			<tr>
				<td>{{ $category->name }}</td>
				<td>
					<img src="/storage/category_images/{{ $category->image }}" class="img-fluid">
				</td>
				<td>
					<a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-secondary">
						Edit
					</a>
				</td>
				<td>
					{{ Form::open(['route'=>['category.destroy', $category->id], 'method'=>'DELETE']) }}
					{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-sm']) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="col-md-4">
	<div class="card mt-4">
		<div class="card-body">
			{!! Form::open(['route'=>'category.store', 'method'=>'POST', 'files' => true]) !!}
			<h2>New Category</h2>

			{{ Form::label('name', 'Name:')}}
			{{ Form::text('name', null, ['class'=>'form-control'])}}

			{{ Form::label('image', "Upload Category Image:", ['class'=>'mt-3']) }}
			{{ Form::file('image') }}

			{{ Form::submit('Create New Category', ['class'=>'btn btn-primary btn-block mt-3'])}}
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection