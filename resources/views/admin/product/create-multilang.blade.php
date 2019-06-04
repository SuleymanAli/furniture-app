@extends('layout.admin')

@section('content')
<div class="col-md-10 mx-auto">
	{!! Form::open(['route' => ['product.storeMultilang', $product->id], 'method' => 'POST','data-parsley-validate' => '', 'files' => true]) !!}
	{{ Form::label('language', 'Language:', ['class'=>'mt-3']) }}
	{{ Form::text('language', null, ['class'=>'form-control', 'required'=>'']) }}
	
	{{ Form::label('title', 'Title:') }}
	{{ Form::text('title', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) }}

	{{ Form::label('keyword', 'Keywords (Please Separate By Comma):', ['class'=>'mt-3']) }}
	{{ Form::text('keyword', null, ['class'=>'form-control', 'required'=>'']) }}

	{{ Form::label('description', 'Description:', ['class'=>'mt-3']) }}
	{{ Form::textarea('description', null, ['class'=>'form-control', 'required'=>'']) }}

	{{ Form::submit('Create Product', ['class'=>'btn btn-success btn-lg btn-block mt-4']) }}
	{!! Form::close() !!}
</div>
@endsection