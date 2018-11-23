@extends('layouts.app')

@section('template_linked_css')
<style type="text/css">
  

</style>
@endsection

@section('content')
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
                <h1>ECR<b><a>Central</a></b></h1>
                <h3>A central platform for early career researchers</h3>
                <p>To find postdoc research fellowships, travel grants and to share experiences and to provide feedback.</p>
                <h3><a href="http://localhost:8000/login" class="btn btn-lg btn-success">Join Now!</a></h3><br>
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

<div class="container">
    <div class="row demo-tiles">
      <div class="row">
        <div class="col-xs-3">
          <div class="tile">
            <!--
            <i class="fa fa-graduation-cap fa-4x"></i>
            -->
            <img src="images/icons/graduation.svg" alt="Fundings" class="tile-image">
            <h3 class="tile-title">Fundings</h3>
            <p>More than 250 fundings</p>
            <a class="btn btn-primary btn-large btn-block" href="{{ route('fundings') }}">View Fundings</a>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="tile">
             <!--
            <i class="fa fa-plane fa-4x"></i>
            -->
            <img src="images/icons/send.svg" alt="Travel Grants" class="tile-image">
            <h3 class="tile-title">Travel Grants</h3>
            <p>More than 100 travel grants</p>
            <a class="btn btn-primary btn-large btn-block" href="#">View Travel Grants</a>
          </div>
        </div>

        <div class="col-xs-3">
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

        <div class="col-xs-3">
          <div class="tile tile">
             <!--
            <i class="fa fa-plus fa-4x"></i>
            -->
            <img src="images/icons/light-bulb.svg" alt="Contribute" class="tile-image">
            <h3 class="tile-title">Contribute</h3>
            <p>Submit funding and travel grants</p>
            <a class="btn btn-primary btn-large btn-block" href="">Submit</a>
          </div>

        </div>
      </div>
  </div>
</div>
<!--
<div class="container">
<div class="row">
        <div class="col-xs-4">
          <h5>Recently added</h5>
          <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title">Recently added</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
          </div>
            
        </div>

        <div class="col-xs-4">
          <h5>Upcoming fellowships</h5>
         
        </div>

        <div class="col-xs-4">
          <h5>Upcoming travel grants</h5>
          
        </div>

  </div>
</div>
-->


@endsection