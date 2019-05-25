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
				<th>#</th>
				<th>Header</th>
				<th>Header</th>
				<th>Header</th>
				<th>Header</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1,001</td>
				<td>Lorem</td>
				<td>ipsum</td>
				<td>dolor</td>
				<td>sit</td>
			</tr>
		</tbody>
	</table>
</div>

@endsection

