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
			<div class="col-md-12">
				<div class="profile">
                    <center>
                    
                    <img src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @endif" alt="{{ $user->name }}"  width="140" height="140" border="0" class="img-circle"><br>
                   
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

                    @if ($user->profile)
	                    @if ($user->profile->bio)
										
						{{ $user->profile->bio }}
						
						<hr>				
						@endif

						<center>
						@if ($user->email)
						 <i class="fa fa-envelope"> </i>
						 	@if (Auth::user()->id == $user->id)
						 		{{ $user->email }}
						 	@else
						 		{{ $user->mask_email($user->email) }}
						 	@endif
						@endif
						@if ($user->profile->organization)
						| <i class="fa fa-bank"> </i> {{ $user->profile->organization }}
						@endif

						@if ($user->profile->website)
						| <i class="fa fa-globe"> </i> <a href="{{ $user->profile->website }}" target="_blank">{{ $user->profile->website }}</a>
						@endif
						 </center>
						 <br><br>
					@endif
						
                </div>
			</div>
		</div>
		  
	</div>
	<div style="background-color: #edf0f1;">
       <div class="container">
        <div class="row">
            <div class="col-lg-12">
            	<br>
            	<br>
            	<!--
                <h4 class="page-header">Curation activities</h4>
            -->
            </div>
            
        </div>

      </div>

    </div>

    @if ($user->profile->location)
    <div class="container">
        <div class="row">
        	<div class="col-md-10 col-md-offset-1">
        	{{ trans('profile.showProfileLocation') }}:
									<small>{{ $user->profile->location }} </small>
				<br />
				@if(config('settings.googleMapsAPIStatus'))
				<!--
				Latitude: <span id="latitude"></span> / Longitude: <span id="longitude"></span>
				--> <br />
				<div id="map-canvas"></div>
				@endif
			</div>
		</div>
	</div>
	@endif
@endsection

@section('footer_scripts')

	@if(config('settings.googleMapsAPIStatus'))
		@include('scripts.google-maps-geocode-and-map')
	@endif

@endsection
