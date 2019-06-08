@if(Session::has('success'))

    <div class="alert alert-success" role="alert" class="mt-4">
        {{ Session::get('success')}}
    </div>

@endif

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <strong>Errors:</strong>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>

@endif

@if(Session::has('message'))

    <div class="alert alert-warning" role="alert" class="mt-4">
        <strong>
            {{ Session::get('message')}}
        </strong>
    </div>

@endif