@extends('layout.admin')

@section('content')

{!! Form::open(['route' => 'product.store', 'data-parsley-validate' => '', 'files' => true]) !!}
{{ Form::label('price', 'Title:') }}
{{ Form::text('price', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) }}

{{ Form::label('image', 'Slug:') }}
{{ Form::text('image', null, ['class'=>'form-control', 'required'=>'', 'minlength'=>'5','maxlength'=>'255']) }}

{{-- {{ Form::label('category_id', 'Category:') }}
<select name="category_id" class="form-control">
	@foreach($categories as $category)
	<option value="{{ $category->id }}">{{ $category->name }}</option>
	@endforeach
</select>
 --}}
{{-- {{ Form::label('featured_image', "Upload Feature Image:") }}
{{ Form::file('featured_image') }} --}}

{{-- {{ Form::label('body', 'Body:', ['class'=>'mt-4']) }}
{{ Form::textarea('body', null, ['class'=>'form-control', 'required'=>'']) }} --}}

{{ Form::submit('Create post', ['class'=>'btn btn-success btn-lg btn-block mt-4']) }}
{!! Form::close() !!}

@endsection
