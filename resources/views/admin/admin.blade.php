@extends('layout.admin')

@section('content')

	<div class="col-md-9">
		<table class="table table-responsive table-striped">
			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>User</th>
				<th>Facebook</th>
				<th>Author</th>
				<th>Admin</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<form action="{{ route('role.assign') }}" method="POST">
							<td>
								{{ $user->name }}
							</td>
							<td>
								{{ $user->email }} 
								<input type="hidden" name="email" value="{{ $user->email }}">
							</td>
							<td>
								<input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user">
							</td>
							<td>
								<input type="checkbox" {{ $user->hasRole('F.User') ? 'checked' : '' }} name="role_f_user">
							</td>
							<td>
								<input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author">
							</td>
							<td>
								<input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin">
							</td>
							{{ csrf_field() }}
							<td>
								<button type="submit" class="btn btn-sm btn-secondary">
									Assign Roles
								</button>
							</td>
						</form>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection