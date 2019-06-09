@extends('layout.app')

@section('content')

@if (Session::has('wish'))
<div class="col-12 mt-4">
	<div class="col-6 mx-auto">
		<h2 class="pb-2">Your Wish List</h2>
		<ul class="list-group">
			@foreach ($products as $product)
			<li class="list-group-item d-flex align-items-baseline">
				<strong>
					{{ $product['item']->translation->first()->title }}
				</strong>
				<span class="badge badge-secondary ml-auto ml-1 mr-3">
					${{ $product['item']['price'] }}
				</span>
				<div class="btn-group">
					<a href="{{ route('withlist.remove', $product['item']['id']) }}" class="btn btn-danger rounded-0">
						Remove
					</a>
					{{-- <a href="{{ route('cart.add', $product['item']['id']) }}" class="btn btn-primary">
						Add To Cart
					</a> --}}
					{{ Form::open(['route'=>['cart.add',  $product['item']['id']], 'method'=> 'POST']) }}

					{{ Form::submit('Add To Cart', ['class'=>'btn btn-primary rounded-0']) }}

					{{ Form::close() }}
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<div class="col-12 my-4">
	<div class="col-6 mx-auto">
		<strong>
			{{-- Total: &dollar;{{ $totalPrice }} --}}
		</strong>
	</div>
</div>

<hr>
@else
<div class="col-12 mt-5 pt-5">
	<div class="col-6 mx-auto">
		<h1 class="text-center jumbotron">No Items In Wish List!</h1>
	</div>
</div>

@endif

@endsection