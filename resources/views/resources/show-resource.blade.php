@extends('layouts.app')

@section('template_title')
Resource - {{ $resource->name }} 
@endsection


@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-header">{{ $resource->name }} <br>
                    <small>{{ $resource->source_name }}</small>
        @if(Auth::user() && Auth::user()->role->name != 'user')
          <div class="pull-right">
            <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/resources/' . $resource->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit</a>
          </div>
        @endif
        </h4>
      </div>

      <div class="col-md-8">
      @if($resource->status == 0)
      <div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Note: This resource is not published/active.
      </div>
      @endif
  
      <div class="panel panel-default">
            <div class="panel-heading">
              <a href="/resources/" class="btn btn-primary btn-xs pull-right">
                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                <span class="hidden-xs">Back to resources</span>
              </a>
             Short description
            </div>
            <div class="panel-body">
              <p><i>{!! $resource->description !!}</i></p>
            </div>
          </div>

      <p>
        <a href="{{ $resource->url }}" target="_blank"><button type="button" class="btn btn-success">Resource website</button></a>
        
        <div class="border-bottom"></div>
      </p>
            
      @include('partials.resource-status')
      
      <hr>
      @if ($resource->updated_at)
       <p>
       <small>
        This entry has been last updated: 
        {{ $resource->updated_at }}</small>
      </p>
      @endif

      </div>

      <div class="col-md-4">
        <small>Share this resource</small><br>
        <a href="https://twitter.com/intent/tweet?text={{$resource->name}}&amp;url={{ urlencode(Request::fullUrl()) }}&amp;via=ecrcentral" title="Tweet" class="btn btn-social-icon btn-sm margin-half btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" title="Share on Facebook" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Google+" class="btn btn-social-icon btn-sm margin-half btn-google"><i class="fa fa-google" aria-hidden="true"></i></a>
        <a href="http://www.linkedin.com/shareArticle?url={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Share on Linkedin" class="btn btn-social-icon btn-sm margin-half btn-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
        <a href="http://service.weibo.com/share/share.php?url={{ urlencode(Request::fullUrl())}}&amp;title={{$resource->name}}" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-info"><i class="fa fa-weibo" aria-hidden="true"></i></a>

        <a href="mailto:?Subject={{$resource->name}}&Body={{ urlencode(Request::fullUrl()) }}" target="_blank" title="Email to someone" class="btn btn-social-icon btn-sm margin-half btn-github"><i class="fa fa-envelope" aria-hidden="true"></i></a>

        <div class="border-bottom"></div>
      

      </div>

      <div class="col-md-4">
        <a href="/{{ Config::get('chatter.routes.home') }}/channel/resources"><button type="button" class="btn btn-primary btn-large btn-block"><b>Ask questions about this resource</b></button></a>

        <div class="border-bottom"></div>

      </div>

        <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Related resources</h3>
          </div>
          <div class="panel-body">
            @if($related_resources)
            <ul>
            @foreach ($related_resources as $rs)
             <li><a href="/resources/{{ $rs->slug }}">{{ $rs->name }}</a></li>
            @endforeach
            </ul>
            @else
                No related resources found.
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

