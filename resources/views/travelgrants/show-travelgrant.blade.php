@extends('layouts.app')

@section('template_title')
  Travel Grant - {{ $travelgrant->name }}
@endsection


@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-header">{{ $travelgrant->name }} <br>
                    <small>{{ $travelgrant->funder_name }}</small>
        @if(Auth::user() && Auth::user()->role->name != 'user')
          <div class="pull-right">
            <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/travel-grants/' . $travelgrant->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit</a>
          </div>
        @endif

    </h4>
      
      </div>

      <div class="col-md-8">
      @if($travelgrant->status == 0)
      <div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Note: This travel grant is not published/active.
      </div>
      @endif
    
      <p><i>{!! $travelgrant->description !!}</i></p>
      <p><b>Purpose</b>: {{ $travelgrant->purpose }}</p>
      <p><b>Subjects</b>: {{ $travelgrant->fields }}</p> 
      <p><b>Award</b>: {{ $travelgrant->award }}</p> 
      
      <p><b>Diversity</b>: {{ $travelgrant->diversity }}</p> 
      <p><b>Memberschip required?</b>: {{ $travelgrant->membership }}</p> 
      <p><b>Minimum time of membership</b>: {{ $travelgrant->membership_time }}</p> 
      <p><b>Comments</b>: {{ $travelgrant->comments }}</p>

      <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <small>
          We make ensure the accuracy, please refer to the call website for complete details about the travel grant.
          <br><b>Note</b>: This is a community curated project, please contribute/report if any information is missing or not correct. We highly appreciate your contributions!
        </small>
    </div>
      <hr>
      @if ($travelgrant->updated_at)
       <p>
       <small>
        This entry has been last updated: 
        {{ $travelgrant->updated_at }}</small>
      </p>
      @endif

      </div>

      <div class="col-md-4">
        <a href="{{ $travelgrant->url }}" target="_blank"><button type="button" class="btn btn-success">Call website</button></a>
        <a href="/forums"><button type="button" class="btn btn-info">Talk to a mentor</button></a>
        <div class="border-bottom"></div>

      </div>

      <div class="col-md-4">
        
        <div class="panel panel-success">

          <div class="panel-heading">
            <a href="/travel-grants/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to travelgrants</span>
            </a>
           Applicant Info
          </div>
          <div class="panel-body">

              <div class="row">
                <div class="col-sm-12">
                  
                   <p><strong>Applicant citizenship</strong>: {{ $travelgrant->applicant_country }}</p> 
                    <p><strong>Career level</strong>: {{ $travelgrant->career_level }}</p> 
                  </div>
                
              </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Deadline</h3>
          </div>
          <div class="panel-body">
            {{ $travelgrant->deadline }}
          </div>
        </div>

      </div>

       <div id="disqus_thread"></div>
    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')

@endsection
