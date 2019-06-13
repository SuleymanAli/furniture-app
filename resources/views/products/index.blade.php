@extends('layout.app')

@section('content')
<div class="col-md-2">
	<ul class="list-unstyled">
		<li class="p-2">
			<a href="{{ route('product.index', ['category' => 0]) }}" class="text-muted">
				All
			</a>
		</li>
	@foreach ($categories as $category)
		<li class="p-2">
			<a href="{{ route('product.index', ['category' => $category->id]) }}" class="text-muted">
				{{ $category->name }}
			</a>
		</li>
	@endforeach
	</ul>
</div>
<div class="col-md-10 d-flex flex-wrap">
	@foreach($products as $product)
	@foreach ($product->translation as $translation)
	<div class="col-4">	
		<div class="card mb-4 shadow-sm d-flex no-gutters">
			<div class="">
				@if(isset($translation->product->image))
				<a href="{{ route('product.show', $translation->slug) }}">
					<img src="/product/{{ $translation->product->id }}/image" class="img-fluid w-100" style="height: 100%">
				</a>
				@endif
			</div>
			<div class="">
				<div class="card-header">
					<a href="{{ route('product.show', $translation->slug) }}">
						<h4 class="my-0 font-weight-normal">
							{{ $translation->title }}
						</h4>
					</a>
				</div>
				<div class="card-body">
					<ul class="list-unstyled">
						<li>{{ substr($translation->description, 0, 150) }}</li>
					</ul>
					<h1 class="card-title pricing-card-title mt-3 mb-4">
						${{ $translation->product->price }}
					</h1>
					
						{{ Form::open(['route'=>['cart.add', $translation->product->id], 'method'=> 'POST']) }}

						{{ Form::submit('Add To Cart', ['class'=>'btn btn-lg btn-block btn-outline-primary']) }}

						{{ Form::close() }}

						{!! Html::linkRoute('withlist.add', 'Add To Wishlist', [$translation->product->id], ['class'=>'mt-2 btn btn-lg btn-block btn-outline-danger']) !!}
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endforeach
	<hr>
</div>

<div class="mx-auto my-4">
	{{ $products->appends(request()->input())->links() }}
</div>

@endsection