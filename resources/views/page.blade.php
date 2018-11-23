@extends('layouts.app')

@section('template_title')
  Showing fundings
@endsection

@section('template_linked_css')

@endsection

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="grid search">
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>{{ $page->title }}</h3>
                        <hr>
                        
                        {!! $page->body !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

