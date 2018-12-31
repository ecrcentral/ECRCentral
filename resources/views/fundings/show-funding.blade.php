@extends('layouts.app')

@section('template_title')
  Showing funding {{ $funding->name }}
@endsection


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-header">{{ $funding->name }} <br>
                    <small>{{ $funding->funder_name }}</small>
          @if(Auth::user() && Auth::user()->role->name != 'user')
          <div class="pull-right">
              <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/fundings/' . $funding->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
              </a>                                     
          </div>
          @endif
        </h4>

      </div>
      <div class="col-md-8">

      @if($funding->status == 0)
      <div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Note: This funding opportunity is not published/active.
      </div>
      @endif

      <p>{!! $funding->description !!}</p>

      <p><b>Award</b>: {{ $funding->award }}</p> 
      <p><b>Award type</b>: {{ $funding->award_type }}</p>
      <p><b>Award Duration</b>: {{ $funding->duration }}</p>  
      <p><b>Research costs</b>: {{ $funding->research_costs }}</p> 
      <p><b>Benefits</b>: {{ $funding->benefits }}</p>      
      <p><b>Diversity</b>: {{ $funding->diversity }}</p> 

      <p><b>Mobility rule</b>: {{ $funding->mobility_rule }}</p> 

      <p><b>Subjects</b>: {{ $funding->fileds }}</p>

      <p><b>Comments</b>: {{ $funding->comments }}</p>

      <!--
      <h5>Subjects</h5>
    
            @foreach ($funding->subjects as $subject)
             <a href="#"><button type="button" class="btn btn-info">{{ $subject->name }}</button></a>
             @endforeach
      -->

      <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <small>
          We make ensure the accuracy, please refer to the call website for complete details about the funding.
          <br><b>Note</b>: This is a community curated project, please contribute/report if any information is missing or not correct. We highly appreciate your contributions!
        </small>
    </div>

      <hr>
       @if ($funding->updated_at)
       <p>
       <small>
        This entry has been last updated: 
        {{ $funding->updated_at }}</small>
      </p>
      @endif

      </div>

      <div class="col-md-4">
        <a href="{{ $funding->url }}" target="_blank"><button type="button" class="btn btn-success">Call website</button></a>
        <a href="/forums/category/funding-schemes"><button type="button" class="btn btn-info">Disscuss this funding</button></a>
        <div class="border-bottom"></div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-success">
          <div class="panel-heading">
            <a href="/fundings/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to fundings</span>
            </a>
           Applicant Info
          </div>
          <div class="panel-body">
                  <p><strong>Applicant citizenship</strong>: {{ $funding->applicant_country }}</p> 
                  <p><strong>Host country</strong>: {{ $funding->host_country }}</p> 
                  <p><strong>Academic level</strong>: {{ $funding->academic_level }}</p> 
                  <p><strong>Years since PhD</strong>: {{ $funding->years_since_phd }}</p> 
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Deadline</h3>
          </div>
          <div class="panel-body">
            {{ $funding->deadline }}
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
