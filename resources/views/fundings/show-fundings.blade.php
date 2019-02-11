@extends('layouts.app')

@section('template_title')
Funding schemes and fellowships for Postdocs and early career researchers  
@endsection

@section('template_title') Funding schemes and fellowships for Postdocs and early career researchers @endsection
@section('og_title') Funding schemes and fellowships for Postdocs and ECRs @endsection
@section('og_url'){{ Request::url() }}@endsection

@section('card_summary')@endsection
@section('description')
A detailed list of funding schemes and fellowships for Postdocs and early career researcher (ECRs)
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

                    <div class="col-md-12">
                      <h4 class="page-header"> Funding schemes and fellowships for early career researchers
                    </h4>
                   </div>
                 </div>
                  <div class="row">
                         
                          <div class="col-md-4">
                            <a class="btn btn-sm btn-warning" href="{{ URL::to('fundings/feed') }}" target="_blank" title="Subscribe to RSS Feeds"><i class="fa fa-rss" aria-hidden="true"></i> Subscribe to Feeds</a>
                            <a class="btn btn-sm btn-primary" href="{{ URL::to('fundings/create') }}" data-toggle="tooltip" title="Add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add New Funding</a>
                          <hr>                          
                            <div id="applicant_countries"></div>
                            <div id="host_countries"></div>
                            <div id="categories"></div>
                          </div>

                            <div class="col-md-8">
                              <div id="searchbox"></div>
                              <div id="stats"></div>
                              <img src="{{ asset('images/algolia.svg') }}" class="pull-right" width="100px">
                              <hr>
                              <div id="current-refinements"></div>
                              
                              <div id="hits" ></div>

                               
                                <div id="pagination"></div>
                            </div>

                  </div><!-- /.row -->                        
                                
                        <!--
                      <div id="disqus_thread"></div>
                    -->
  
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
<script src="{{ asset('js/algolia.js') }}"></script>
@endsection

