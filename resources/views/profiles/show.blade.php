@extends('layouts.app')

@section('template_title')
	{{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

@endsection

@section('content')
<br>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="profile">
                    <center>
                    
                    <img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}"  width="140" height="140" border="0" class="img-circle"><br>
                    <small>@ {{ $user->name }}</small>
                    <h3 class="media-heading">{{ $user->first_name }} {{ $user->last_name }} <small>{{ $user->title }}</small></h3>

                    
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

                    </center>
                    <span class="pull-right">
                    	@if ($user->profile)
							@if (Auth::user()->id == $user->id)

								{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-small btn-info btn-block')) !!}

							@endif
						@else

							<p>{{ trans('profile.noProfileYet') }}</p>
							{!! HTML::icon_link(URL::to('/profile/'.Auth::user()->name.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-small btn-info btn-block')) !!}

						@endif
                    </span>
                    <hr>

                    <center>
                    @if ($user->profile->bio)
									
					{{ $user->profile->bio }}
					
					<hr>				
					@endif
                   

                    	<dl class="user-info">

							
							@if ($user->email)

							<dt>
								{{ trans('profile.showProfileEmail') }}
							</dt>
							<dd>
								{{ $user->email }}
							</dd>
							@endif

							@if ($user->profile)

								@if ($user->profile->theme_id)
									<dt>
										{{ trans('profile.showProfileTheme') }}
									</dt>
									<dd>
										{{ $currentTheme->name }}
									</dd>
								@endif

								@if ($user->profile->location)
									<dt>
										{{ trans('profile.showProfileLocation') }}
									</dt>
									<dd>
										{{ $user->profile->location }} <br />

										@if(config('settings.googleMapsAPIStatus'))
											Latitude: <span id="latitude"></span> / Longitude: <span id="longitude"></span> <br />

											<div id="map-canvas"></div>
										@endif
									</dd>
								@endif
							@endif

						</dl>
						 </center>
                </div>
			</div>
		</div>
		  
	</div>
@endsection

@section('footer_scripts')

	@if(config('settings.googleMapsAPIStatus'))
		@include('scripts.google-maps-geocode-and-map')
	@endif

@endsection
