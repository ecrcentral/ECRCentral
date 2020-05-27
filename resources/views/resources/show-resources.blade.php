@extends('layouts.app')


@section('template_title') List of Resources for Postdocs and early caree researchers @endsection
@section('og_title') List of Resources for Postdocs and early caree researchers @endsection
@section('og_url'){{ Request::url() }}@endsection

@section('card_summary')@endsection
@section('description')
A detailed list of useful Resources for PhDs, Postdocs and early career researcher (ECRs)
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch-theme-algolia.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
<div class="container">
<div class="row">
    <!-- BEGIN SEARCH RESULT -->
    <div class="col-md-12">
        <div class="grid search">
            <div class="grid-body">
                <div class="row">
                    <!-- BEGIN FILTERS -->
                    
                    <div class="col-md-12">
                        <h4 class="page-header"> Resources for early career researchers
                         </h4>
                    </div>
                    <!-- END RESULT -->
                </div>
                 <div class="row">
                         
                          <div class="col-md-4">
                           <a class="btn btn-sm btn-warning" href="{{ URL::to('resources/feed') }}" target="_blank" title="Subscribe to RSS Feeds"><i class="fa fa-rss" aria-hidden="true"></i> Subscribe to Feeds</a>
                            <a class="btn btn-sm btn-primary" href="{{ URL::to('resources/create') }}" data-toggle="tooltip" title="Add New Resource"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add New Resource</a>
                          <hr>                                                      
                            <div id="categories"></div>
                          </div>

                            <div class="col-md-8">
                              <div id="searchbox"></div>
                              <div id="stats"></div>
                              <img src="{{ asset('images/algolia.svg') }}" class="pull-right" width="100px">
                              <hr>
                              <div id="hits" ></div>
                               
                            <div id="pagination"></div>
                            </div>

                  </div><!-- /.row --> 

            </div>
        </div>
    </div>
    <!-- END SEARCH RESULT -->
</div>
</div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.8.0/dist/instantsearch.min.js"></script>
<script src="{{ asset('js/algolia-resources.js') }}?v=1.0"></script>

@endsection

