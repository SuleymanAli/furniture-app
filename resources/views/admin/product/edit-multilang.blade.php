@extends('layout.admin')

@section('content')
<div class="col-md-10 mx-auto">
	{!! Form::model($translation, ['route' => ['product.updateMultilang', $translation->id], 'method' => 'PUT','data-parsley-validate' => '', 'files' => true]) !!}
	{{ Form::label('language', 'Language:', ['class'=>'mt-3']) }}
	{{ Form::text('language', null, ['class'=>'form-control', 'required'=>'']) }}

	{{ Form::label('title', 'Title:', ['class'=>'mt-3']) }}
	{{ Form::text('title', null, ['class'=>'form-control', 'required'=>'', 'maxlength'=>'255']) }}

	{{-- <div id="keywordWrapper">
	{{ Form::label('keyword', 'Keyword:', ['class'=>'mt-3']) }}
	@foreach ($translation->keywords as $keyword)
	{{ Form::text('keyword[]', $keyword->name, ['class'=>'col-5 form-control mt-2', 'required'=>'', 'maxlength'=>'255']) }}
	@endforeach
		<a class="btn btn-sm btn-success text-light mt-2" id="addKeyword">
			+ Add Keyword
		</a>
	</div> --}}

	{{ Form::label('description', 'Description:', ['class'=>'mt-3']) }}
	{{ Form::textarea('description', null, ['class'=>'form-control', 'required'=>'']) }}

	{{ Form::submit('Create Product', ['class'=>'btn btn-success btn-lg btn-block mt-4']) }}
	{!! Form::close() !!}
</div>
@endsection

@section('js')

{{-- <script>
	$(document).ready(function() {
		var max_fields      = 10; //maximum input boxes allowed
		var wrapper   		= $("#keywordWrapper"); //Fields wrapper
		var add_button      = $("#addKeyword"); //Add button ID

		var x = 1; //initlal text box count

		$(add_button).click(function(e){ 
			//on add input button click
			e.preventDefault();

			//max input box allowed
			if(x < max_fields){ 
				x++; //text box increment
				$(wrapper).append('<div class="row m-auto no-gutters pt-3"><input class="col-5 form-control px-3" required="" maxlength="255" name="keyword[]" type="text" value=""><a href="" class="remove_field text-center btn btn-sm btn-danger my-auto mx-2">X</a><div>'); //add input box
			}
		});

		$(wrapper).on("click",".remove_field", function(e){ 
			//user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	})
</script> --}}

@endsection