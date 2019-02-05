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
                    @if ($page->slug == 'about' || $page->slug == 'team')
                    <small>ECRcentral</small>
                    @endif
                @if(Auth::user() && Auth::user()->role->name != 'user')
                  <div class="pull-right">
                      <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/pages/' . $page->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
                      </a>                                     
                  </div>
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

