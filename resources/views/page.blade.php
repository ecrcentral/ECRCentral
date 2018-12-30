@extends('layouts.app')

@section('template_title')
  {{ $page->title }}
@endsection

@section('template_linked_css')

@endsection

@section('content')
<div class="container">
<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">{{ $page->title }}
                    @if ($page->slug == 'about')
                    <small>ECRcentral</small>
                    @endif
                </h3>
                
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <p>{!! $page->body !!}</p>
                           
            </div>
        </div>
</div>

@endsection

