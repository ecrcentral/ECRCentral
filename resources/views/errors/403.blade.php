@extends('layouts.app')

@section('template_title')
403 - Forbidden
@endsection


@section('content')
    <div class="container">
         <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">403
                    <small>Forbidden</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">403</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1><span class="error-403">403</span>
                    </h1>
                    <p>The page you're looking for is forbidden.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
