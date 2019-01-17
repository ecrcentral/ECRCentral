@extends('layouts.app')

@section('template_title')
	{{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')

<style type="text/css">
	
</style>

@endsection

@section('content')
<br>
<div class="container">
<div class="row">
<div id="pad-wrapper">
    <div class="col-md-4">

    <div class="panel panel-default">
    
    <div class="panel-body no-padding">
    	<div class="profile">

                    <center>
                    
                    @if (($user->profile->avatar) && $user->profile->avatar_status == 1)

                    <img src="{{ $user->profile->avatar }}" alt="{{ $user->name }}" alt="{{ $user->name }}" width="140" height="140" border="0" class="img-circle">

                    @else
                    <img class="round" width="140" height="140" avatar="@if ($user->first_name !=NULL && $user->last_name !=NULL) {{ $user->first_name }} {{ $user->last_name }} @else {{ $user->name }} @endif">
                    @endif

                    <br>
                   
                    <h3 class="media-heading">{{ $user->first_name }} {{ $user->last_name }} <small>{{ $user->profile->title }}</small></h3>
                    @if ($user->profile->organization)
                    {{ $user->profile->organization }}
                    <br>
					@endif

                    @if ($user->profile->orcid)
                     <a href="https://orcid.org/{{ $user->profile->orcid }}" target="_blank">
                     	<i class="ai ai-orcid ai-2x"></i>
                     </a>
					@endif
                    
                     @if ($user->profile->twitter_username)
                     <a href="https://twitter.com/{{ $user->profile->twitter_username }}" target="_blank">
                     	<i class="fa fa-twitter fa-2x"> </i>
                     </a>
					@endif

					@if ($user->profile->github_username)
						<a href="https://github.com/{{ $user->profile->github_username }}" target="_blank">
                     	<i class="fa fa-github fa-2x"> </i>
                     </a>
					@endif

					@if ($user->profile->linkedin_username)
                     <a href="{{ $user->profile->linkedin_username }}" target="_blank">
                     	<i class="fa fa-linkedin fa-2x"> </i>
                     </a>
					@endif

                    </center>

                </div>

        
        <div class="ibox-content profile-content">
        	<hr>
        	 <div class="user-button">
                <div class="row">


                    <div class="col-md-3">
                    
                    </div>
                    <!--
                    <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-sm btn-block">
                        <i class="fa fa-check"></i> Follow</button>
                    </div>
                -->

                    <div class="col-md-6">
                    	@if ($user->profile)
							@if (Auth::user()->id == $user->id)

								{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-sm btn-info btn-block')) !!}
							@else

							<button type="button" class="btn btn-primary btn-sm btn-block">
                        		<i class="fa fa-envelope"></i> Message</button>

							@endif
						@else

							<p>{{ trans('profile.noProfileYet') }}</p>
							{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-sm btn-info btn-block')) !!}

						@endif
                    </div>

                    <div class="col-md-3">
                    
                    </div>

                </div>
            </div>

            <hr>
           
            <h6><strong>Bio</strong></h6>
            
            @if ($user->profile)
	                @if ($user->profile->bio)
						{{ $user->profile->bio }}
						<hr>				
						@endif
						@if ($user->email)
						 <i class="fa fa-envelope"> </i>
						 	@if (Auth::user()->id == $user->id)
						 		{{ $user->email }}
						 	@else
						 		{{ $user->mask_email($user->email) }}
						 	@endif
						@endif
						 @if ($user->profile->organization)
							<br><i class="fa fa-bank"> </i> {{ $user->profile->organization }}
						@endif
						
						@if ($user->profile->website)
						<br> <i class="fa fa-globe"> </i> <a href="{{ $user->profile->website }}" target="_blank">{{ $user->profile->website }}</a>
						@endif
			@endif

			<hr>	

            <div class="row m-t-lg">
                <div class="stats">                        
                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $posts->count() }}</strong></span><br> Posts</p>
                    </div><!-- /statis -->
                    
                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $funding_count }}</strong></span><br>Funding</p>
                    </div> <!-- /statis -->
                    
                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $travelgrants_count }}</strong></span><br>Grants</p>
                    </div> <!-- /statis --> 

                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $resources_count }}</strong></span><br>Resources</p>
                    </div> <!-- /statis --> 
                </div>
            </div><!-- /row m-t-lg -->

           
        </div><!-- /profile-content -->
    </div>
    </div>
    </div>
    
    <div class="col-md-8">
    <div class="panel panel-default">
    <div class="panel-heading"><strong>Forum Activities</strong>

   
                </div>
    <div class="panel-body">
        
        <div class="ibox-content">
           <div class="feed-activity-list">

		        @foreach($posts as $post)
		          <div class="feed-element">
                    <a href="#" class="pull-left">
                    <img alt="image" class="img-circle" src="@if ($post->user->profile->avatar != NULL) {{ $post->user->profile->avatar }} @endif">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                        <strong>@if ($post->user->first_name){{ $post->user->first_name }} @else {{ $post->user->name }} @endif</strong> left a reply on <strong><a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $post->discussion->category->slug }}/{{ $post->discussion->slug }}"> {{ $post->discussion->title }}</a></strong><br>
                        <small class="text-muted">{{ $post->created_at }}</small>
                            <div class="well">
                            <small>{!! $post->body !!}</small>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                <a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                <a class="btn btn-xs btn-primary" href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $post->discussion->category->slug }}/{{ $post->discussion->slug }}"><i class="fa fa-pencil"></i> Reply</a>
                            </div>
                    </div>
                </div><!-- feed-element-->
			    @endforeach

                                
            </div><!--feed-activity-list-->

            <!--
            <button class="btn btn-cprimary btn-block ">
                <i class="fa fa-arrow-down"></i> Show More
            </button>
        -->

            {{ $posts->links() }}

        </div><!-- feed-activity-list -->
    </div><!--ibox-content -->
    </div>
    </div>
    </div>

    <div class="clearfix"></div>
  </div>
</div>
@endsection

@section('footer_scripts')

	@if(config('settings.googleMapsAPIStatus'))
		@include('scripts.google-maps-geocode-and-map')
	@endif

@endsection
