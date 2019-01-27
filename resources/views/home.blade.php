@extends('layouts.app')

@section('template_title')
A central platform for early career researchers community
@endsection

@section('socials_card')
@include('partials.socials-card')
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/algolia-autocomplete.css') }}">
@endsection

@section('content')
<div id="headerwrap">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
              <center>             
                <h2>A central platform for early career researchers community</h2>
                <h1><a>Create</a>. <a>Contribute</a>. <a>Engage</a>.</h1>
            </center>
          </div>
        </div>
        <div class="row">             
              <div class="col-lg-12 col-md-12">
                <center>
                <a href="@if(Auth::user()) /forums @else /register @endif">
                 <button class="btn btn-embossed btn-primary">Join the Community</button></a>
               </center>
               </div>
        </div>

        <div class="row"> 
              <div class="col-md-8 col-md-offset-2">
                <center>
                <br>
                  <div class="form-group">
                  <input type="search" id="aa-search-input" class="aa-input-search input-lg" placeholder="Search for funding schemes and travel grants..." name="search" autocomplete="on" />

                  <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                      <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                  </svg>
                </div>
             
              </center>
            </div>
            <br><br>

        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <p class="lead" align="center">
              By early career researchers (ECRs) for ECRs to find and discuss funding opportunities, share experiences, mentor peers, and create impact through community engagement.
            </p>
        
      </div>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->

<div class="container">
    <div class="row demo-tiles">
      <div class="row">
        <div class="col-md-3">
          <div class="tile" align="center">
            <!--
            <i class="fa fa-graduation-cap fa-4x"></i>
            -->
            <img src="images/icons/graduation.svg" alt="Fundings" class="tile-image" width="50%">
            <h3 class="tile-title">Funding</h3>
            <p>Browse <b>{{ $total_fundings }} </b> funding and <b>{{ $total_travelgrants }}</b> travel grant opportunities</p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('fundings') }}">View Funding</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile" align="center">
             <!--
            <i class="fa fa-plane fa-4x"></i>
            -->
            <img src="images/icons/desktop.svg" alt="Travel Grants" class="tile-image" width="50%">
            <h3 class="tile-title">Resources</h3>
            <p>A curated list of useful resources for ECRs</p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('resources') }}">View Resources</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="tile" align="center">
             <!--
            <i class="fa fa-credit-card fa-4x"></i>
            -->
            <img src="images/icons/global.svg" alt="Funders" class="tile-image" width="50%">
            <h3 class="tile-title">Community</h3>
            <p>Bringing ECR community together to network and mentor</p>
            <a class="btn btn-primary btn-large btn-block" href="/forums">Join the Community</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="tile tile" align="center">
             <!--
            <i class="fa fa-plus fa-4x"></i>
            -->
            <img src="images/icons/network.svg" alt="Contribute" class="tile-image" width="50%">
            <h3 class="tile-title">Contribute</h3>
            <p>Add <a href="{{ route('fundings') }}/create">funding</a>, 
              <a href="{{ route('travelgrants') }}/create">travel grants</a> and
              <a href="{{ route('resources') }}/create">resources</a> useful for ECRs</p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('getinvolved') }}">Get Involved</a>
          </div>

        </div>
      </div>
  </div>
</div>


<div style="background-color: #edf0f1; padding-bottom: 30px; padding-top: 0px;">
    <div class="container">

          <div class="row"> 

            <div class="col-md-6">
              <h4 class="page-header">Featured postdoctoral fellowships</h4>

               @foreach($featured_fundings as $funding)
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-star fa-stack-1x fa-inverse"></i>
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

                <div class="col-md-6">
                  <h4 class="page-header">Featured travel grants</h4>

                   @foreach($featured_travelgrants as $travelgrant)
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
                            <small><b>Funder</b>: {{$travelgrant->funder_name}} | <b>Subject</b>: {{$travelgrant->fields}}</small>
                            </p>

                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
              <h4 class="page-header">Upcomming funding opportunities</h4>

               @foreach($fundings as $funding)
                <div class="media">
                    <div class="pull-left">
                        <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
                        </span> 
                    </div>
                    <div class="media-body">
                        <strong><a href="{{ route('fundings') }}/@if($funding->slug){{$funding->slug}}@else{{$funding->id}}@endif">{{$funding->name}}</a></strong>
                        <p>
                        <small>{{$funding->funder_name}} | <b>Deadline</b>: {{$funding->deadline}}</small>
                        </p>

                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-md-6">
                  <h4 class="page-header">Featured resources</h4>

                   @foreach($featured_resources as $resource)
                    <div class="media">
                        <div class="pull-left">
                            <span class="fa-stack fa-2x">
                                  <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                  <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                            </span> 
                        </div>
                        <div class="media-body">
                            <strong><a href="{{ route('resources') }}/@if($resource->slug){{$resource->slug}}@else{{$resource->id}}@endif">{{$resource->name}}</a></strong> <small class="text-muted">  by {{$resource->source_name}} </small>
                            <p>{{ substr(strip_tags($resource->description), 0, 115) }}@if(strlen(strip_tags($resource->description)) > 115){{ '...' }}@endif</p>
                        </div>
                    </div>
                    @endforeach
            </div>

          </div>
    </div>

           
 <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="page-header">Recent discussions from ECR community forum</h4>
            <div class="ibox-content">
               <div class="feed-activity-list">
                 @foreach($discussions as $discussion)
                  <div class="feed-element">
                        <a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}" class="pull-left">
                        @if(Config::get('chatter.user.avatar_image_database_field'))

                          <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                          <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                          @if (($discussion->user->profile->avatar) && $discussion->user->profile->avatar_status == 1)
                          <img src="{{ $discussion->user->profile->avatar }}" alt="{{ $discussion->user->name }}" width="50" height="50" border="0" class="img-circle">

                          @else
                            @if ($discussion->user->first_name && $discussion->user->last_name)
                            <img class="round" width="50" height="50" avatar="{{ $discussion->user->first_name }} {{ $discussion->user->last_name }}">
                            @else
                            <img class="round" width="50" height="50" avatar="{{ $discussion->user->name }}">
                            @endif
                          @endif

                        
                        @endif
                        </a>
                        <div class="media-body ">
                            <small class="pull-right">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}</small>
                            <small class="text-muted"> <a href="/profile/{{ $discussion->user->name }}"> {{ ucfirst($discussion->user->name) }}</a></small> posted on
                             <strong><a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}"> {{ $discussion->title }} </a></strong> in channel <span class="badge badge-secondary" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</span> 
                            
                                <div class="well">
                                   @if($discussion->post[0]->markdown)
                                    <?php $discussion_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $discussion->post[0]->body ); ?>
                                  @else
                                    <?php $discussion_body = $discussion->post[0]->body; ?>
                                  @endif
                                  <p>{{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif</p>
                                </div>
                                <div class="pull-right">
                                    
                                    <a class="btn btn-xs btn-white" title="Total replies"><i class="fa fa-pencil"></i> {{ $discussion->postsCount[0]->total }} </a>
                                    <a class="btn btn-xs btn-white" title="Total views"><i class="fa fa-eye"></i> {{ $discussion->views }} </a>
                                  
                                    <a class="btn btn-xs btn-primary" href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}"><i class="fa fa-reply"></i> Reply</a>
                                </div>
                        </div>
                    </div>
              @endforeach

                </div>
                {{ $discussions->links() }}
        </div>
    </div>


  </div>
</div>

<br><br>
<div id="intro2">
  <div class="container">
          <div class="row centered">
              <p class="lead" align="center">
                This is a community curated catalog of useful resources for early career researchers <a href="{{ route('getinvolved')}}">
                  <button class="btn btn-danger"><b>Get involved and create impact</b></button></a></p>
        </div>
  </div>
</div>

@endsection

@section('js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia-autocomplete.js') }}"></script>
@endsection


