@extends('layout.admin')

@section('content')
<div class="col-md-8">
	<div class="card mt-4">
		<div class="card-body">
			{!! Form::model($category, ['route'=> ['category.update', $category->id], 'method'=>'PUT', 'files' => true]) !!}
			<h2>New Category</h2>

			{{ Form::label('name', 'Name:')}}
			{{ Form::text('name', $category->name, ['class'=>'form-control'])}}

			{{ Form::label('image', "Upload Category Image:", ['class'=>'mt-3 mb-2 d-block']) }}
			{{ Form::file('image') }}

			{{ Form::submit('Create New Category', ['class'=>'btn btn-primary btn-block mt-3'])}}
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection