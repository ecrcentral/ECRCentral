@extends('layouts.app')

@section('template_title')
A central platform for early career researchers
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
        <div class="row centered">
            <div class="col-lg-12">
                <h1>ECR<b><a>Central</a></b></h1>
                <h3>A central platform for early career researchers</h3>
                <p>To find postdoc research fellowships, travel grants and to share experiences and to provide feedback.</p>
                 <a href="/register" class="btn btn-lg btn-success">Join Now!</a>
                <div class="aa-input-container" id="aa-input-container">
                  <div class="input-group input-group-lg">

                  <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search for funding schemes, fellowships & travel grants for early career researchers ..." name="search" autocomplete="off" />
                  <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                      <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                  </svg>
                </div>
              </div>
              <br><br>
            </div>

           
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <p class="lead" align="center">A community curated catalog of fundings & travel grants for early career researchers </p>
        <hr>
      </div>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->


</div>

<div class="container">
    <div class="row demo-tiles">
      <div class="row">
        <div class="col-md-3">
          <div class="tile">
            <!--
            <i class="fa fa-graduation-cap fa-4x"></i>
            -->
            <img src="images/icons/graduation.svg" alt="Fundings" class="tile-image">
            <h3 class="tile-title">Fundings</h3>
            <p><b>{{ $total_fundings }} </b> funding opportunities</p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('fundings') }}">View Fundings</a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile">
             <!--
            <i class="fa fa-plane fa-4x"></i>
            -->
            <img src="images/icons/send.svg" alt="Travel Grants" class="tile-image">
            <h3 class="tile-title">Travel Grants</h3>
            <p><b> {{ $total_travelgrants }} </b> travel grants</p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('travelgrants') }}">View Travel Grants</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="tile">
             <!--
            <i class="fa fa-credit-card fa-4x"></i>
            -->
            <img src="images/icons/desktop.svg" alt="Funders" class="tile-image">
            <h3 class="tile-title">Forums</h3>
            <p>Discuss opportunities</p>
            <a class="btn btn-primary btn-large btn-block" href="/forums">Discuss Now</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="tile tile">
             <!--
            <i class="fa fa-plus fa-4x"></i>
            -->
            <img src="images/icons/light-bulb.svg" alt="Contribute" class="tile-image">
            <h3 class="tile-title">Contribute</h3>
            <p>Submit <a href="{{ route('fundings') }}/create">fundings</a> and 
              <a href="{{ route('travelgrants') }}/create">travel grants</a></p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('fundings') }}/create">Submit</a>
          </div>

        </div>
      </div>
  </div>
</div>

 <!--
      <div style="background-color: #edf0f1;">
       <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Services Panels</h4>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-primary"></i>
                              <i class="fa fa-dollar fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                      <h3 class="tile-title">Fundings</h3>
                      <p>More than 250 fundings</p>
                      <a class="btn btn-primary " href="{{ route('fundings') }}">View Fundings</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-danger"></i>
                              <i class="fa fa-plane fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                      <h3 class="tile-title">Travel Grants</h3>
                      <p>More than 100 travel grants</p>
                      <a class="btn btn-primary " href="{{ route('travelgrants') }}">View Fundings</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-warning"></i>
                              <i class="fa fa-comments fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                      <h3 class="tile-title">Forums</h3>
                      <p>Discuss opportunities</p>
                      <a class="btn btn-primary" href="/forums">Discuss Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <span class="fa-stack fa-5x">
                              <i class="fa fa-circle fa-stack-2x text-info"></i>
                              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="panel-body">
                        <h3 class="tile-title">Contribute</h3>
                        <p>Submit fundings/travel grants</p>
                        <a class="btn btn-primary" href="{{ route('fundings') }}/create">Fundings</a>
                        <a class="btn btn-primary" href="{{ route('travelgrants') }}/create">Travel Grants</a>
                    </div>
                </div>
            </div>
        </div>

      </div>

     </div>
-->
        <div style="background-color: #edf0f1;">
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
                  <h4 class="page-header">Recent blog posts</h4>

                   @foreach($posts as $post)
                    <div class="media">
                        <div class="pull-left">
                            <span class="fa-stack fa-2x">
                                  <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                  <i class="fa fa-file fa-stack-1x fa-inverse"></i>
                            </span> 
                        </div>
                        <div class="media-body">
                            <strong><a href="{{ route('posts') }}/@if($post->slug){{$post->slug}}@else{{$post->id}}@endif">{{$post->title}}</a></strong>
                            <p>{{$post->excerpt}} <br>
                            <small><i class="fa fa-clock-o"></i> Posted on <b> {{$post->created_at->format('F d, Y')}} </b> by <a href="profile/{{$post->authorId['name']}}"> <b>{{$post->authorId['name']}}</b></a> | <a href="blog/{{$post->slug}}">Read more <i class="fa fa-angle-right"></i></a>
                            </small>
                            </p>

                        </div>
                    </div>
                    @endforeach
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


