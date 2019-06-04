@extends('layout.app')

@section('content')
<ul class="list-unstyled d-flex">
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
<div class="col-md-12 mx-auto d-flex flex-wrap">
	@foreach($products as $product)
	@foreach ($product->translation as $translation)
	<div class="col-6">	
		<div class="card mb-4 shadow-sm d-flex flex-row no-gutters">
			<div class="col-6 order-2">
				@if(isset($translation->product->image))
				<a href="{{ route('product.show', $translation->slug) }}">
					<img src="{{ asset('storage/product_images/'.$translation->product->image) }}" class="img-fluid w-100" style="height: 100%">
				</a>
				@endif
			</div>
			<div class="col-6 order-1">
				<div class="card-header">
					<a href="{{ route('product.show', $translation->slug) }}">
						<h4 class="my-0 font-weight-normal">
							{{ $translation->title }}
						</h4>
					</a>
				</div>
				<div class="card-body">
					<h1 class="card-title pricing-card-title">
						${{ $translation->product->price }}
					</h1>
					<ul class="list-unstyled mt-3 mb-4">
						<li>{{ $translation->description }}</li>
					</ul>
					<a href="{{ route('product.show', $translation->slug) }}">
						<button type="button" class="btn btn-lg btn-block btn-outline-primary">
							Add To Cart
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endforeach
	{{-- <hr>{{ dd(request()->route()) }} <br> --}}
	<hr>{{ App::getLocale() }} <br>
	@lang('home.hello') <br>
	<ul class="d-block">
		<li>
			<a href="{{ route('lang', 'en') }}">
				En
			</a>
		</li>
		<li>
			<a href="{{ route('lang', 'az') }}">
				Az
			</a>
		</li>
		<li>
			<a href="{{ route('lang', 'de') }}">
				De
			</a>
		</li>
	</ul>
</div>

@endsection