@extends('layouts.app')

@section('template_title')
  Funder {{ $funder->name }}
@endsection


@section('content')
<br><br>
  <div class="container">
    
    <div class="row">
      <div class="col-md-12">
      <h4><i class="fa fa-search-o"></i> {{ $funder->name }}</h4>
      {{ $funder->country }} <br>
      <i class="ai ai-orcid"></i> <a href="http://dx.doi.org/10.13039/{{$funder->funder_id}}" target="_blank">http://dx.doi.org/10.13039/{{$funder->funder_id}}</a>
      
      <div class="pull-right">
          <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/funders/' . $funder->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
          </a>                                     
      </div>
      <hr>
      </div>

    </div>


    <div class="row">
            <div class="col-md-12">
              <h4 class="page-header">Funding opportunities <small> offered by {{ $funder->name }}</small></h4>

               @foreach($funder->fundings as $funding)
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-bank fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <strong><a href="{{ route('fundings') }}/@if($funding->slug){{$funding->slug}}@else{{$funding->id}}@endif">{{$funding->name}}</a></strong>
                        <p>
                        <small><b>Funder</b>: {{$funding->funder_name}} | <b>Deadline</b>: {{$funding->deadline}}</small>
                        </p>

                    </div>
                </div>
                @endforeach
               </div>

               <!--
                <div class="col-md-6">
                  <h4 class="page-header">Travel grants</h4>

                   @foreach($funder->fundings as $travelgrant)
                    <div class="media">
                        <div class="pull-left">
                            <span class="fa-stack fa-2x">
                                  <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                  <i class="fa fa-plane fa-stack-1x fa-inverse"></i>
                            </span> 
                        </div>
                        <div class="media-body">
                            <strong><a href="{{ route('travelgrants') }}/@if($travelgrant->slug){{$travelgrant->slug}}@else{{$travelgrant->id}}@endif">{{$travelgrant->name}}</a></strong>
                            <p>
                            <small><b>Funder</b>: {{$travelgrant->funder_name}} | <b>Subject</b>: {{$travelgrant->subjects}}</small>
                            </p>

                        </div>
                    </div>
                    @endforeach
                </div>
              -->
          </div>

    <div class="row">
            <div class="col-lg-12"> 
       <div id="disqus_thread"></div>
     </div>

    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')

@endsection
