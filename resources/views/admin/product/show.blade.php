@extends('layout.admin')

@section('content')

<div class="col-md-8">
    <div class="card">
        <img src="/product/{{ $product->id }}/image" alt="" class="img-fluid">
        <div class="card-body">
            <h5 class="card-title">
                Category: {{$product->category->name}}
            </h5>

            <a href="#" class="btn btn-primary">
                Price: {{$product->price}}
            </a>
            @foreach ($product->translationAll as $translation)
            <div class="row bg-success rounded p-2 my-2 no-gutters">
                <h5 class="col-6 card-title">
                    Title: {{ $translation->title }}
                </h5>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <a href="{{ route('product.editMultilang', $translation->id) }}" class="btn btn-sm btn-secondary mr-2">
                        Edit
                    </a>
                    {!! Form::open(['route' => ['product.destroyMultilang', $translation->id], 'method'=>'DELETE']) !!}                     

                    {!! Form::submit('X', ['class'=>'btn btn-sm btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
                <p class="col-12 card-text">
                    Description: {{$translation->description}}
                </p>
                <p class="col-12 card-text text-white">
                    lang: {{$translation->language}}
                </p>
                <p class="col-12 card-text text-white">
                    Keyword: 
                    @foreach ($translation->keywords as $keyword)
                    <span class="badge badge-warning p-2 ml-1">    
                        {{ $keyword->name }}
                    </span>
                    @endforeach
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="bg-light border rounded p-2">
        <dl class="dl-horizontal">
            <label>URL Slug:</label>
            <p>
                @foreach ($product->translationAll as $translation)
                <a href="{{ url('product/'.$translation->slug) }}" class="d-block badge badge-pill badge-dark mb-1" target="_blank">
                    {{ url('product/'.$translation->slug) }}
                </a>
                @endforeach
            </p>
        </dl>
        <dl class="dl-horizontal">
            <label>Category:</label>
            <p>{{ $product->category->name }}</p>
        </dl>
        <dl class="dl-horizontal">
            <label>Created At:</label>
            <p>{{ date('M j, Y h:i', strtotime($product->created_at)) }}</p>
        </dl>
        <dl class="dl-horizontal">
            <label>Last Updated:</label>
            <p>{{ date('M j, Y h:i', strtotime($product->updated_at)) }}</p>
        </dl>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                {!! Html::linkRoute('admin.edit', 'Edit', [$product->id], ['class'=>'btn btn-primary btn-block']) !!}
            </div>
            <div class="col-sm-6">

                {!! Form::open(['route' => ['admin.destroy', $product->id], 'method'=>'DELETE']) !!}                     

                {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}

                {!! Form::close() !!}

            </div>
            <div class="col-md-12 mt-4">
                {!! Html::linkRoute('admin.index', '<< See All products', null, ['class'=>'btn btn-block btn-info']) !!}
            </div>
        </div>
    </div>
</div>

<div class="col-12">
        <div id="backed-comments" class="mt-3">
            <h3>
                Comments
                <small class="text-muted">
                    {{ $product->comments()->count() }}
                    Total
                </small>
            </h3>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->comments as $comment)
                    <tr>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->user->email }}</td>
                        <td>
                            {{ substr($comment->comment_content, 0, 90) }}
                            {{ strlen($comment->comment_content) > 100 ? "..." : '' }}
                        </td>
                        <td>
                            {{ Form::open(['route'=>['comments.destroy', $comment->id], 'method'=> 'DELETE']) }}

                            {{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) }}

                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
