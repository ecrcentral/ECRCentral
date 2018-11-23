@extends('layouts.app')

@section('template_title')
  Showing travelgrant {{ $travelgrant->name }}
@endsection


@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h4><i class="fa fa-search-o"></i> {{ $travelgrant->name }}</h4>
      {{ $travelgrant->funder_name }}
      <hr>
      </div>
      <div class="col-md-8">

      <p><i>{{ $travelgrant->description }}</i></p>
      <p>Award: {{ $travelgrant->award }}</p> 
      <p>Award type: {{ $travelgrant->award_type }}</p>
      <p>Award Duration: {{ $travelgrant->duration }}</p>  
      <p>Research costs: {{ $travelgrant->research_costs }}</p> 
      <p>Subjects: </p> 
      <p>Diversity: {{ $travelgrant->diversity }}</p> 
      <p>Deadline: {{ $travelgrant->deadline }}</p>
      <p>URL: {{ $travelgrant->url }}</p> 
      <p>Comments: {{ $travelgrant->comments }}</p> 

      </div>

      <div class="col-md-4">
        
        <div class="panel panel-success">

          <div class="panel-heading">
            <a href="/travelgrants/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to travelgrants</span>
            </a>
           Applicant Info
          </div>
          <div class="panel-body">

              <div class="row">
                <div class="col-sm-12">
                  
                   <p><strong>Applicant citizenship</strong>: {{ $travelgrant->applicant_country }}</p> 
                    <p><strong>Host country</strong>: {{ $travelgrant->host_country }}</p> 
                    <p><strong>Academic level</strong>: {{ $travelgrant->academic_level }}</p> 
                    <p><strong>Years since PhD</strong>: {{ $travelgrant->years_since_phd }}</p> 
                  </div>
                
              </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>      

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($travelgrant->created_at)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelCreatedAt') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $travelgrant->created_at }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($travelgrant->updated_at)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelUpdatedAt') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $travelgrant->updated_at }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

          </div>
        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')

@endsection
