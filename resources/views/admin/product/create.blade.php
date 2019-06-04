	@extends('layout.admin')

	@section('content')
	<div class="col-md-10 mx-auto">
		{!! Form::open(['route' => 'admin.store', 'data-parsley-validate' => '', 'files' => true]) !!}
		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) }}

		{{ Form::label('language', 'Language:', ['class'=>'mt-3']) }}
		{{ Form::text('language', null, ['class'=>'form-control', 'required'=>'']) }}

		{{ Form::label('price', 'Price:', ['class'=>'mt-3']) }}
		{{ Form::text('price', null, ['class'=>'form-control', 'required'=>'']) }}

		{{ Form::label('category_id', 'Category:', ['class'=>'mt-3']) }}
		<select name="category_id" class="form-control">
			@foreach($categories as $category)
			<option value="{{ $category->id }}">{{ $category->name }}</option>
			@endforeach
		</select>

		{{ Form::label('image', "Upload Feature Image:", ['class' => 'mt-3 d-block']) }}
		{{ Form::file('image', ['class' => 'd-block']) }}

		{{ Form::label('description', 'Description:', ['class'=>'mt-3']) }}
		{{ Form::textarea('description', null, ['class'=>'form-control', 'required'=>'']) }}

		{{ Form::submit('Create Product', ['class'=>'btn btn-success btn-lg btn-block mt-4']) }}
		{!! Form::close() !!}
	</div>
	@endsection
