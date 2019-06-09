@extends('layout.app')

@section('content')

<div class="col-8 mx-auto my-4">
	<h1>User Profile</h1>
	<hr>
	<h2>My Orders</h2>
	@foreach ($orders as $order)
		<div class="card my-4">
			<div class="card-body">
				<ul class="list-group list-group-flush">
					@foreach ($order->cart->items as $item)
						<li class="list-group-item d-flex justify-content-between align-items-start">
							{{ $item['item']->translation->first()->title }} | {{ $item['qty'] }} Units
							<span class="badge badge-primary">
								${{ $item['price'] }}
							</span>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="card-footer">
				<strong>Total Price: ${{ $order->cart->totalPrice }}</strong>
			</div>
		</div>
	@endforeach
</div>

@endsection