@extends('layouts.app')

@section('template_title')
  Showing funding {{ $funding->name }}
@endsection


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-header">{{ $funding->name }} <br>
                <small>
                    @if($funding->funders()->exists())
                      @foreach ($funding->funders as $funder)
                        {{ $loop->first ? '' : ', ' }}
                        {{ $funder->name }}
                      @endforeach
                    @else
                      {{ $funding->funder_name }}
                      @endif
                  </small>
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
        @if($funding->description)
        <p>{!! $funding->description !!}</p>
        @endif

          <div class="panel panel-default">
            <div class="panel-heading">
              <a href="/fundings/" class="btn btn-primary btn-xs pull-right">
                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                <span class="hidden-xs">Back to funding</span>
              </a>
             Applicant and host information
            </div>
            <div class="panel-body">
                <p><strong>Applicant citizenship</strong>: {{ $funding->applicant_country }}</p> 
                <p><strong>Host country</strong>: {{ $funding->host_country }}</p> 
                @if($funding->academic_level)<p><strong>Academic level</strong>: {{ $funding->academic_level }}</p>@endif
                <p><strong>Years since PhD</strong>: {{ $funding->years_since_phd }}</p> 
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">Award details</div>
            <div class="panel-body">
              <p><b>Award</b>: {{ $funding->award }}</p> 
              @if($funding->award_type)<p><b>Award type</b>: {{ $funding->award_type }}</p>@endif
              <p><b>Award Duration</b> (years): {{ $funding->duration }}</p>  
              <p><b>Research costs</b>: {{ $funding->research_costs }}</p> 
              <p><b>Benefits</b>: {{ $funding->benefits }}</p>      
              <p><b>Diversity</b>: {{ $funding->diversity }}</p> 

              <p><b>Mobility rule</b>: {{ $funding->mobility_rule }}</p>

              <p><b>Subjects</b>: 
              @if($funding->subjects()->exists())
                    @foreach ($funding->subjects as $subject)
                      {{ $loop->first ? '' : ', ' }}
                     <a href="#">{{ $subject->name }}</a>
                    @endforeach
              @elseif($funding->fileds)
                  {{ $funding->fileds }}
              
              @else
                  Please check the <a href="{{ $funding->url}}" target="_blank">website</a>
              @endif
              </p>
            </div>
          </div>

        @if($funding->comments)<p><b>Additional comments</b>: {{ $funding->comments }}</p>@endif

        <p><b>How to apply?</b> For further eligibility requirements and the application process, please visit the
        <a href="{{ $funding->url }}" target="_blank"><b>official website</b></a>.</p>

       <hr>
      </div>
      <div class="col-md-4">
        <a href="https://twitter.com/intent/tweet?text={{$funding->name}}&amp;url={{ urlencode(Request::fullUrl()) }}&amp;via=ecrcentral" target="_blank" title="Tweet" class="btn btn-social-icon btn-sm margin-half btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Facebook" class="btn btn-social-icon btn-sm margin-half btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Google+" class="btn btn-social-icon btn-sm margin-half btn-google"><i class="fa fa-google" aria-hidden="true"></i></a>
        <a href="http://www.linkedin.com/shareArticle?url={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Linkedin" class="btn btn-social-icon btn-sm margin-half btn-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
        <a href="mailto:?Subject={{$funding->name}}&Body={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Email to someone" class="btn btn-social-icon btn-sm margin-half btn-github"><i class="fa fa-envelope" aria-hidden="true"></i></a>
        <div class="border-bottom"></div>
      </div>

      <div class="col-md-4">
        <a href="/forums/category/funding-schemes"><button type="button" class="btn btn-primary"><b>Ask questions about this funding</b></button></a>
        <div class="border-bottom"></div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title">Application deadline</h3>
          </div>
          <div class="panel-body">
            @if($funding->deadline)
            {{ $funding->deadline }}
            @else
            Please check the <a href="{{ $funding->url}}" target="_blank">website</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Related funding</h3>
          </div>
          <div class="panel-body">
            @if($related_fundings)
            <ul>
            @foreach ($related_fundings as $rf)
             <li><a href="/fundings/{{ $rf->slug }}">{{ $rf->name }}</a></li>
            @endforeach
            </ul>
            @else
                No related funding options found.
            @endif
            
          </div>
        </div>
      </div>

      <div class="col-md-4">
      @include('partials.resource-status')       
         @if ($funding->updated_at)
         <p>
         <small>
          This entry has been last updated: 
          {{ $funding->updated_at }}</small>
        </p>
        @endif
      </div>

      <div class="col-md-12">
       <div id="disqus_thread"></div>
      </div>
    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')

@endsection
