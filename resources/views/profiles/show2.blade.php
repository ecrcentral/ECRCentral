@extends('layouts.app')

@section('template_title')
	{{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')

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
                    	@if ($user->first_name && $user->last_name)
                    	<img class="round" width="140" height="140" avatar="{{ $user->first_name }} {{ $user->last_name }}">
                    	@else
                    	<img class="round" width="140" height="140" avatar="{{ $user->name }}">
                    	@endif
                    
                    @endif

                    <br>                   
                    <h4 class="media-heading">{{ $user->first_name }} {{ $user->last_name }} <small>{{ $user->profile->title }}</small></h4>
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
           
            <h6><strong>Short biography</strong></h6>
            
            @if ($user->profile)
	                @if ($user->profile->bio)
						{{ $user->profile->bio }}
						
					@else
					No biography added.
					@endif
					<hr>

						 <i class="fa fa-user"> </i> Joined on  
						 {{ $user->created_at->format('M d, Y') }}</br>
						 <i class="fa fa-user"> </i> Last seen 
						 @if ($user->last_login_at) 
						 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans() }}
						 @else
						 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->created_at))->diffForHumans() }}
						 @endif
						</br>

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

            <div class="m-t-lg">
            	<h6><strong>Contribution stats</strong></h6>
                <div class="stats">
                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $posts->count() }}</strong></span><br> Posts</p>
                    </div>
                    
                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $funding_count }}</strong></span><br>Funding</p>
                    </div> 
                    
                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $travelgrants_count }}</strong></span><br>Grants</p>
                    </div> 

                    <div class="statis">
                    <p><span class="badge badge-primary"><strong>{{ $resources_count }}</strong></span><br>Resources</p>
                    </div> 
                </div>
            </div>

            <hr>
        	 <div class="user-button">
                <div class="row">

                    	@if ($user->profile)
							@if (Auth::user()->id == $user->id)

								<div class="col-md-6">
                                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {!! trans('titles.logout') !!}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
	                            </div>

								<div class="col-md-6">

								{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-sm btn-info btn-block')) !!}
							    </div>
								
							@else

								<!--
									This feature will be added in the future
								-->

								<!--
								<div class="col-md-6">
								<button type="button" class="btn btn-primary btn-sm btn-block">
	                        		<i class="fa fa-envelope"></i> Message</button>
	                        	</div>

	                        	<div class="col-md-6">
			                    <button type="button" class="btn btn-primary btn-sm btn-block">
			                        <i class="fa fa-check"></i> Follow</button>
			                    </div>

			                -->

							@endif
						@else
							<div class="col-md-12">
							<p>{{ trans('profile.noProfileYet') }}</p>
							{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-sm btn-info btn-block')) !!}

							</div>

						@endif
                   
                </div>
            </div>
        </div><!-- /profile-content -->
    </div>
    </div>
    </div>
    
    <div class="col-md-8">
    <div class="panel panel-default">
    <div class="panel-heading">{{ ucfirst($user->name) }}'s <strong>Recent Activity</strong></div>
    <div class="panel-body">
        
        <div class="ibox-content">
           <div class="feed-activity-list">

		        @foreach($posts as $post)
		          <div class="feed-element">
                    <a href="/profile/{{ $post->user->name }}" class="pull-left">
                    @if (($post->user->profile->avatar) && $post->user->profile->avatar_status == 1)
                    <img src="{{ $post->user->profile->avatar }}" alt="{{ $post->user->name }}" width="50" height="50" border="0" class="img-circle">

                    @else
                    	@if ($post->user->first_name && $post->user->last_name)
                    	<img class="round" width="50" height="50" avatar="{{ $post->user->first_name }} {{ $post->user->last_name }}">
                    	@else
                    	<img class="round" width="50" height="50" avatar="{{ $post->user->name }}">
                    	@endif
                    @endif
                    </a>
                    <div class="media-body ">
                        <small class="pull-right">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                        <a href="/profile/{{ $post->user->name }}"><strong>{{ ucfirst($post->user->name) }}</strong></a> posted on <strong><a href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $post->discussion->category->slug }}/{{ $post->discussion->slug }}"> {{ $post->discussion->title }}</a></strong><br>
                        <small class="text-muted">{{ $post->created_at }}</small>
                            <div class="well">
                            @if($post->markdown)
                                    <?php $post_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ); ?>
                                  @else
                                    <?php $post_body = $post->body; ?>
                                  @endif
                                  <p>{{ substr(strip_tags($post_body), 0, 200) }}@if(strlen(strip_tags($post_body)) > 200){{ '...' }}@endif</p>

                            </div>
                            <div class="pull-right">
                            	<a class="btn btn-xs btn-white" title="Total replies"><i class="fa fa-pencil"></i> {{ $post->discussion->postsCount[0]->total }} </a>
                                    <a class="btn btn-xs btn-white" title="Total views"><i class="fa fa-eye"></i> {{ $post->discussion->views }} </a>
                                <a class="btn btn-xs btn-primary" href="/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $post->discussion->category->slug }}/{{ $post->discussion->slug }}"><i class="fa fa-pencil"></i> Reply</a>
                            </div>
                    </div>
                </div><!-- feed-element-->
			    @endforeach

			    @if ($posts->count() == 0)
			    	{{ ucfirst($user->name) }} is not active enough yet. 

			    @endif

                                
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
