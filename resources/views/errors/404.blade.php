@extends('layouts.app')
@section('title', 'Error page')

@section('css')
    <style type="text/css">
        .error-template {
            padding: 40px 15px;
            text-align: center;
        }

        .error-actions {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .error-actions .btn {
            margin-right: 10px;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        404 Not Found</h2>
                    <div class="error-details">
                        Sorry, an error has occured, Requested page not found!
                    </div>
                    <div class="error-actions">
                        @if (App::getLocale() == 'ar')
                            <a href="{{ url('') }}" class="btn btn-success btn-lg"><span
                                    class="glyphicon glyphicon-home"></span>
                                Take Me Home </a>
                            <a href="{{ url('/contact') }}" class="btn btn-default btn-lg"><span
                                    class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                        @else
                            <a href="{{ url('en') }}" class="btn btn-success btn-lg"><span
                                    class="glyphicon glyphicon-home"></span>
                                Take Me Home </a>
                            <a href="{{ url('en/contact') }}" class="btn btn-default btn-lg"><span
                                    class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
