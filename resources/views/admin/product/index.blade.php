@extends('layout.admin')

@section('content')

<h2>Section title</h2>
<div class="ml-auto mr-2">
	<a href="{{ route('admin.create') }}" class="btn btn-sm btn-success">
		Add
	</a>
</div>
<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>Id</th>
				<th>Price</th>
				<th>Category</th>
				<th>Image</th>
				<th>Add Lang</th>
				<th>View Product</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $product)
			<tr>
				<td>
					{{ $product->id }}
				</td>
				<td>
					$ {{ $product->price }}
				</td>
				<td>
					@if ($product->category_id)
						{{ $product->category->name }}
					@endif
				</td>
				<td>
					{{ substr($product->image,0, 20) }}
				</td>
				<td>
					<a href="{{ route('product.createMultilang', $product->id) }}" class="btn btn-sm btn-success">
						Add Language
					</a>
				</td>
				<td>
					<a href="{{ route('admin.show', $product->id) }}" class="btn btn-sm btn-secondary">
						View
					</a>
				</td>
				<td>
					<a href="{{ route('admin.edit', $product->id) }}" class="btn btn-sm btn-primary">
						Edit
					</a>
				</td>
				<td>
					{!! Form::open(['route' => ['admin.destroy', $product->id], 'method'=>'DELETE']) !!}                     
                    
                    {!! Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) !!}

                    {!! Form::close() !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection

