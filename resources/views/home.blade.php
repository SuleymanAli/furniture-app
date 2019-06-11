@extends('layout.app')

@section('content')

<div class="container">
    {{ dd(Auth::user()->roles) }}
    @if (session('status'))
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-5">
        @foreach ($categories as $category)
        <div class="col-3">
            <a href="{{ route('product.index', ['category' => $category->id]) }}">
                <img src="/storage/category_images/{{ $category->image }}" class="img-fluid">
                <storng class="d-flex justify-content-center py-2">{{ $category->name }}</storng>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
