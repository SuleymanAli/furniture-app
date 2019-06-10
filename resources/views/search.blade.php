@extends('layout.app')

@section('content')
<div class="col-12 my-2">
	<h2>Search Results</h2>
	{{ $translations->total() }} results for '{{ request()->input('query') }}'
</div>
<div class="col-12 my-2">
	<div class="row">
		@foreach($translations as $translation)
		<div class="col-4">	
			<div class="card mb-4 shadow-sm d-flex no-gutters">
				<div class="">
					@if(isset($translation->product->image))
					<a href="{{ route('product.show', $translation->slug) }}">
						<img src="{{ asset('storage/product_images/'.$translation->product->image) }}" class="img-fluid w-100" style="height: 100%">
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
		{{-- {{ $translation->product->title }} --}}
		@endforeach
	</div>
	<div class="mx-auto my-4">
		{{ $translations->appends(request()->input())->links() }}
	</div>
</div>
@endsection