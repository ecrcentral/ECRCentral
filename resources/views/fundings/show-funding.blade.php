@extends('layouts.app')

@section('template_title')
  Showing funding {{ $funding->name }}
@endsection


@section('content')
<br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h4><i class="fa fa-search-o"></i> {{ $funding->name }}</h4>
      {{ $funding->funder_name }}
      
      <div class="pull-right">
          <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('fundings/' . $funding->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
          </a>                                     
      </div>
      <hr>
      </div>
      <div class="col-md-8">

      <p>{!! $funding->description !!}</p>
      
      <p>Diversity: {{ $funding->diversity }}</p> 
      <p>Comments: {{ $funding->comments }}</p> 

       @if ($funding->updated_at)
       <p><strong>
        Last updated: </strong>
        {{ $funding->updated_at }}</p>
      @endif

      </div>

      <div class="col-md-4">
        <a href="/forums"><button type="button" class="btn btn-info">Talk to a mentor</button></a>
        <a href="{{ $funding->url }}" target="_blank"><button type="button" class="btn btn-success">Call website</button></a>
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

      <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Award info</h3>
          </div>
          <div class="panel-body">
            <p>Award: {{ $funding->award }}</p> 
            <p>Award type: {{ $funding->award_type }}</p>
            <p>Award Duration: {{ $funding->duration }}</p>  
            <p>Research costs: {{ $funding->research_costs }}</p> 
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Subjects</h3>
          </div>
          <div class="panel-body">
            <ul>
            @foreach ($funding->subjects as $subject)
             <li>{{ $subject->name }}</li> 
             @endforeach
             </ul>
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
