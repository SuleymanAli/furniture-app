@extends('layout.app')

@section('title','| Contact Us')

@section('content')
    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Hello, world!</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a
                    jumbotron and three supporting pieces of content. Use it as a starting point to create something more
                    unique.
                </p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">

                <form class="col-md-9 mx-auto" method="POST" action="{{ url('contact') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label name="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label name="subject">Subject:</label>
                        <input type="subject" class="form-control" id="subject" name="subject">
                    </div>
                    <div class="form-group">
                        <label name="message">Message:</label>
                        <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                    </div>
                    <input type="submit" value="Send Message" class="btn btn-success">
                </form>
            </div>

            <hr>

        </div>
        <!-- /container -->

    </main>
@endsection