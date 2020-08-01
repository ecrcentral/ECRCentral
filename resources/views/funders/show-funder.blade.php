@extends('layouts.app')

@section('template_title')
  Funder {{ $funder->name }}
@endsection


@section('content')
<br><br>
  <div class="container">
    
    <div class="row">
      <div class="col-md-12">
      <h4><i class="fa fa-search-o"></i>{{ $funder->name }}</h4>
      {{ $funder->country }}  
       @if($funder->dora == '1')
       | <img src="{{ asset('images/dora.png') }}" height="20px"> DORA signatory
      @endif
      <br>
      
      @if($funder->funder_id == $funder->slug)
        @if($funder->url != '')
          <i class="fa fa-external-link"></i>
          <a href="{{$funder->url}}" target="_blank">{{$funder->url}}</a>
        @endif
      @else
      
       <i class="ai ai-doi"></i>
      <a href="http://dx.doi.org/10.13039/{{$funder->funder_id}}" target="_blank">http://dx.doi.org/10.13039/{{$funder->funder_id}}</a>
      @endif

      
      @if(Auth::user() && Auth::user()->role->name != 'user')
      <div class="pull-right">
          <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/funders/' . $funder->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
          </a>                                     
      </div>
      @endif
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
                        <small><b>Applicant country</b>: {{$funding->applicant_country}} | <b>Host country</b>: {{$funding->host_country}} | <b>Deadline</b>: {{$funding->deadline}}</small>
                        </p>

                    </div>
                </div>
                @endforeach
               </div>

            
                <div class="col-md-12">
                  <h4 class="page-header">Travel grants <small> offered by {{ $funder->name }}</small></h4>

                   @foreach($funder->travelgrants as $travelgrant)
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
                            <small><b>Subject</b>: @if($travelgrant->subjects()->exists())
                              @foreach ($travelgrant->subjects as $subject)
                              {{ $loop->first ? '' : ', ' }}
                               <a href="#">{{ $subject->name }}</a>
                              @endforeach
                            @elseif($travelgrant->fields)
                                {{ $travelgrant->fields }}
                            
                            @else
                                Please check the website
                            @endif

                             | <b>Travel purpose</b>: 
                            @if($travelgrant->purposes)
                                  @foreach ($travelgrant->purposes as $purpose)
                                  {{ $loop->first ? '' : ', ' }}
                                   {{ $purpose->name }}
                                  @endforeach
                            @elseif($travelgrant->fileds)
                                {{ $travelgrant->purpose }}
                            @else
                                Please check the <a href="{{ $travelgrant->url}}" target="_blank">website</a>
                            @endif
                           </small>
                            </p>

                        </div>
                    </div>
                    @endforeach
                </div>
          
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
