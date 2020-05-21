@extends('layouts.app')

@section('template_title'){{ $travelgrant->name }} by {{ $travelgrant->funder_name }}@endsection
@section('og_title'){{ $travelgrant->name }} by {{ $travelgrant->funder_name }}@endsection
@section('og_url'){{ Request::url() }}@endsection

@section('card_summary')@endsection
@section('description')
{{ $travelgrant->name }} by {{ $travelgrant->funder_name }} for {{ $travelgrant->purpose }} in the subject {{ $travelgrant->fields }}
@endsection
@section('published_time'){{ $travelgrant->created_at }}@endsection
@section('modified_time'){{ $travelgrant->updated_at }}@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-header">{{ $travelgrant->name }} <br>
                <small>
                    @if($travelgrant->funders()->exists())
                      @foreach ($travelgrant->funders as $funder)
                        <a href="/funders/{{ $funder->slug }}">{{ $funder->name }}</a>
                      @endforeach
                    @else
                      {{ $travelgrant->funder_name }}
                      @endif
                  </small>
          @if(Auth::user() && Auth::user()->role->name != 'user')
          <div class="pull-right">
              <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/travel-grants/' . $travelgrant->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
              </a>                                     
          </div>
          @endif
        </h4>

      </div>
      
      <div class="col-md-8">

        @if($travelgrant->status == 0)
        <div class="alert alert-danger fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Note: This travel grant opportunity is not published/active.
        </div>
        @endif

         @if($travelgrant->description)
          <p>{!! $travelgrant->description !!}</p>
        @endif

          <div class="panel panel-default">
            <div class="panel-heading">
              <a href="/travel-grants/" class="btn btn-primary btn-xs pull-right">
                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                <span class="hidden-xs">Back to travel grants</span>
              </a>
             Applicant and travel award details
            </div>
            <div class="panel-body">
              <p><strong>Applicant citizenship</strong>: {{ $travelgrant->applicant_country }}</p> 
                @if($travelgrant->career_level)<p><strong>Academic level</strong>: {{ $travelgrant->career_level }}</p>@endif

              <p><b>Travel purpose</b>: 
                @if($travelgrant->purposes)
                      @foreach ($travelgrant->purposes as $purpose)
                      {{ $loop->first ? '' : ', ' }}
                       <a href="#">{{ $purpose->name }}</a>
                      @endforeach
                @elseif($travelgrant->fileds)
                    {{ $travelgrant->purpose }}
                @else
                    Please check the <a href="{{ $travelgrant->url}}" target="_blank">website</a>
                @endif
              </p>
            
              <p><b>Award</b>: {{ $travelgrant->award }}</p>
              @if($travelgrant->award_type)<p><b>Award type</b>: {{ $travelgrant->award_type }}</p>@endif
              <p><b>Memberschip required?</b>: @if($travelgrant->membership == 0) No @elseif($travelgrant->membership == 1) Yes @else {{ $travelgrant->membership }} @endif</p>
              <p><b>Memberschip duration</b> (years): {{ $travelgrant->membership_time }}</p>  
              <p><b>Diversity</b>: {{ $travelgrant->diversity }}</p> 
              <p><b>Subjects</b>: 
                @if($travelgrant->subjects()->exists())
                      @foreach ($travelgrant->subjects as $subject)
                      {{ $loop->first ? '' : ', ' }}
                       <a href="#">{{ $subject->name }}</a>
                      @endforeach
                @elseif($travelgrant->fields)
                    {{ $travelgrant->fields }}
                
                @else
                    Please check the website
                @endif
              </p>
            </div>
          </div>

        @if($travelgrant->comments)<p><b>Additional comments</b>: {{ $travelgrant->comments }}</p>@endif

        <p><b>How to apply?</b> For further eligibility requirements and the application process, please visit the
        <a href="{{ $travelgrant->url }}" target="_blank"><b>official website</b></a>.</p>
        @include('partials.resource-status')       
         @if ($travelgrant->updated_at)
         <p>
         <small>
          This entry has been last updated: 
          {{ $travelgrant->updated_at }}</small>
        </p>
        @endif

       <hr>
      </div>

      <div class="col-md-4">
        <small>Share this travel grant</small><br>
        <a href="https://twitter.com/intent/tweet?text={{$travelgrant->name}}&amp;url={{ urlencode(Request::fullUrl()) }}&amp;via=ecrcentral" target="_blank" title="Tweet" class="btn btn-social-icon btn-sm margin-half btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Facebook" class="btn btn-social-icon btn-sm margin-half btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="http://www.linkedin.com/shareArticle?url={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Linkedin" class="btn btn-social-icon btn-sm margin-half btn-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
        <a href="http://service.weibo.com/share/share.php?url={{ urlencode(Request::fullUrl())}}&amp;title={{$travelgrant->name}}" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-info"><i class="fa fa-weibo" aria-hidden="true"></i></a>
        <a href="mailto:?Subject={{$travelgrant->name}}&Body={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Email to someone" class="btn btn-social-icon btn-sm margin-half btn-github"><i class="fa fa-envelope" aria-hidden="true"></i></a>
        <div class="border-bottom"></div>
      </div>

      <div class="col-md-4">
        
        <a href="/{{ Config::get('chatter.routes.home') }}/channel/travel-grants"><button type="button" class="btn btn-primary btn-large btn-block"><b>Ask questions about this travel grant</b></button></a>
        <div class="border-bottom"></div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title">Application deadline</h3>
          </div>
          <div class="panel-body">
            @if($travelgrant->deadline)
            {{ $travelgrant->deadline }}
            @else
            Please check the website
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Related travel grants</h3>
          </div>
          <div class="panel-body">
            @if($related_travelgrants)
            <ul>
            @foreach ($related_travelgrants as $rt)
             <li><a href="/travel-grants/{{ $rt->slug }}">{{ $rt->name }}</a></li>
            @endforeach
            </ul>
            @else
                No related travel grants found.
            @endif
            
          </div>
        </div>
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
  <script type="text/javascript">
    $(document).ready(function() {
    $('.btn-social-icon').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
});
  </script>

@endsection
