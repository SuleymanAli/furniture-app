@extends('layout.admin')

@section('content')
<div class="col-md-10 mx-auto">
	{!! Form::model($product, ['route' => ['admin.update', $product->id], 'method'=> 'PUT', 'data-parsley-validate' => '', 'files' => true]) !!}
	{{-- {{ Form::label('title', 'Title:') }}
	{{ Form::text('title', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) }}

	{{ Form::label('slug', 'Slug:', ['class'=>'mt-3']) }}
	{{ Form::text('slug', null, ['class'=>'form-control', 'required'=>'']) }}

	{{ Form::label('language', 'Language:', ['class'=>'mt-3']) }}
	{{ Form::text('language', null, ['class'=>'form-control', 'required'=>'']) }} --}}

	{{ Form::label('price', 'Price:', ['class'=>'mt-3']) }}
	{{ Form::text('price', null, ['class'=>'form-control']) }}

	{{ Form::label('category_id', 'Category:', ['class'=>'my-2']) }}
	{{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}

	{{ Form::label('image', "Upload Feature Image:", ['class' => 'mt-3 d-block']) }}
	{{ Form::file('image', ['class' => 'mb-3 d-block']) }}

	@if (!isset($product->image)))
		<img src="{{ asset('storage/product_images/'.$product->image) }}" alt="" class="img-fluid d-block">
	@else
		<img src="{{ asset('storage/product_images/no-image.png') }}" alt="" class="img-fluid d-block">
	@endif

	{{-- {{ Form::label('description', 'Description:', ['class'=>'mt-3']) }}
	{{ Form::textarea('description', null, ['class'=>'form-control', 'required'=>'']) }} --}}

	{{ Form::submit('Update Product', ['class'=>'btn btn-success btn-lg btn-block mt-4']) }}
	{!! Form::close() !!}
</div>
@endsection
