@extends('layout.app')

@section('content')

	<div class="col-12">	
		<div class="card mb-4 shadow-sm d-flex flex-row no-gutters">
			<div class="col-6 order-2">
				@if(isset($productTranslation->product->image))
				<img src="{{ asset('storage/product_images/'.$productTranslation->product->image) }}" class="img-fluid w-100" style="height: 100%">
				@endif
			</div>
			<div class="col-6 order-1">
				<div class="card-header">
					<h4 class="my-0 font-weight-normal">{{ $productTranslation->title }}</h4>
				</div>
				<div class="card-body">
					<h1 class="card-title pricing-card-title">
						${{ $productTranslation->product->price }}
					</h1>
					<ul class="list-unstyled mt-3 mb-4">
						<li>{{ $productTranslation->description }}</li>
					</ul>
					<a href="{{ route('login') }}">
						<button type="button" class="btn btn-lg btn-block btn-outline-primary">
							Add To Cart
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="col-md-8 mx-auto">
		@foreach($productTranslation->product->comments as $comment)
		<div class="comment jumbotron p-4 my-3 bg-info text-white">
			<div class="d-flex justify-content-between">
				<p>
					<strong>Name: </strong>
					{{ $comment->user->name }}
				</p>
				@if(Auth::check() && Auth::user()->id == $comment->user->id)
					{{ Form::open(['route'=>['comments.destroy', $comment->id], 'method'=> 'DELETE']) }}

					{{ Form::submit('X', ['class'=>'btn btn-sm btn-danger']) }}

					{{ Form::close() }}
				@endif
			</div>
			<p>
				<strong>Comment: </strong><br>
				{{ $comment->comment_content }}
			</p>
		</div>
		@endforeach
	</div>
	<div id="comment-form" class="col-md-8 mx-auto">
		@auth
		{{ Form::open(['route'=>['comments.store', $productTranslation->id], 'method'=>'POST']) }}

		<div class="row">
			<div class="col-6 ml-auto">
				{{ Form::label('name', 'Name:', ['class'=>'mt-3']) }}
				{{ Form::text('name', auth()->user()->name, ['class'=>'form-control']) }}
			</div>
			<div class="col-6 mr-auto">
				{{ Form::label('email', 'Email:', ['class'=>'mt-3']) }}
				{{ Form::text('email', auth()->user()->email, ['class'=>'form-control']) }}
			</div>
			<div class="col-12 mx-auto">
				{{ Form::label('comment', 'Comment:') }}
				{{ Form::textarea('comment_content', null, ['class'=>'form-control', 'rows'=>'3']) }}

				{{ Form::submit('Add Comment', ['class'=>'btn btn-success mt-3']) }}
			</div>
		</div>

		{{ Form::close() }}
		@endauth

		@guest
			Please 
			<a href="{{ route('login') }}" class="text-primary">
				Login
			</a>
			And 
			<a href="{{ route('register') }}" class="text-primary">
				Register
			</a>
			For Typing Comment
		@endguest
	</div>

@endsection