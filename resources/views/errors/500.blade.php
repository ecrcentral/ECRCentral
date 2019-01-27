@extends('layouts.app')

@section('template_title')
500 - Internal Server Error
@endsection


@section('content')
    <div class="container">
         <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">500
                    <small>Internal Server Error</small>
                </h4>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">500</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1><span class="error-500">500</span>
                    </h1>
                    <p>Internal Server Error.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
