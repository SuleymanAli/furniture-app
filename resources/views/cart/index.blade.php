@extends('layout.app')

@section('content')

@if (Session::has('cart'))
<div class="col-12 mt-4">
	<div class="col-6 mx-auto">
		<ul class="list-group">
			@foreach ($products as $product)
			<li class="list-group-item d-flex align-items-baseline">
				<span class="badge badge-dark mr-3">
					{{ $product['qty'] }}
				</span>
				<strong>
					{{ $product['item']->translation->first()->title }}
				</strong>
				<span class="badge badge-secondary ml-auto ml-1 mr-3">
					{{ $product['price'] }}
				</span>
				<div class="btn-group">
					<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
						Action
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu p-2">
						<li>
							<a href="{{ route('cart.reduce', $product['item']['id']) }}">
								Reduce By 1
							</a>
						</li>
						<li>
							<a href="{{ route('cart.remove', $product['item']['id']) }}">
								Reduce All
							</a>
						</li>
					</ul>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<div class="col-12 my-4">
	<div class="col-6 mx-auto">
		<strong>
			Total: &dollar;{{ $totalPrice }}
		</strong>
	</div>
</div>

<hr>
<div class="col-12 my-2">
	<div class="col-6 mx-auto">
		<a href="{{ route('checkout') }}" type="button" class="btn btn-success">
			Checkout
		</a>
	</div>
</div>

@else
<div class="col-12 mt-5 pt-5">
	<div class="col-6 mx-auto">
		<h1 class="text-center jumbotron">No Items In Cart!</h1>
	</div>
</div>

@endif

@endsection