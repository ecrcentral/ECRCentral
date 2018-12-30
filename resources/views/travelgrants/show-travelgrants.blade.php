@extends('layouts.app')

@section('template_title')
  Travel Grants for PhDs, Postdocs and ECRs
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch-theme-algolia.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/algolia.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

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
                        <h4 class="page-header"><i class="fas fa-plane-departure"></i> Travel grants for early career researchers
                         <div class="pull-right">
                         <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('travel-grants/create') }}" data-toggle="tooltip" title="Add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add travel grants
                      </a>
                        </div></h4>
                    </div>
                    <!-- END RESULT -->
                </div>
                 <div class="row">
                         
                          <div class="col-md-4">                            
                            <div id="applicant_countries"></div>
                            <div id="host_countries"></div>
                            <div id="categories"></div>
                          </div>

                            <div class="col-md-8">
                              <div id="searchbox"></div>
                              <p class="pull-right"> <div id="stats"></div></p>
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
<script src="{{ asset('js/algolia-travelgrants.js') }}"></script>

@endsection

