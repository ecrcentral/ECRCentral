@extends('layouts.app')

@section('template_title')
ECR Community moderators
@endsection

@section('template_linked_css')

<style type="text/css">
    .card {
    border: none;
    background: #edf0f1;
}
.joined_date {
    font-size: 10px;
}
.organization {
    font-size: 11px;
}
</style>

@endsection

@section('content')
<div class="container">
<!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Community<small>moderators</small></h3>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            
            @foreach($moderators as $moderator)

            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center">
                <div class="thumbnail">
                    
                    @if (($moderator->profile) && $moderator->profile->avatar_status == 1)
                        <img src="{{ $moderator->profile->avatar }}" alt="{{ $moderator->name }}" width="100" height="100" border="0" class="img-circle">
                    @else
                        @if ($moderator->first_name && $moderator->last_name)
                        <img class="round" width="140" height="140" avatar="{{ $moderator->first_name }} {{ $moderator->last_name }}">
                        @else
                        <img class="round" width="140" height="140" avatar="{{ $moderator->name }}">
                        @endif
                    @endif

                    <div class="caption">
                        <a href="/profile/{{ $moderator->name }}">@if ($moderator->first_name && $moderator->last_name) {{ $moderator->first_name }} {{ $moderator->last_name }} @else {{ $moderator->name }} @endif</a>
                        @if ($moderator->profile->organization)
                        <div class="organization">{{ $moderator->profile->organization }}</div>
                        @endif
                        <div class="joined_date">Joined {{ $moderator->created_at->format('M d, Y') }}

                        <br>Last seen 
                        @if ($moderator->last_login_at) 
                         {{ \Carbon\Carbon::createFromTimeStamp(strtotime($moderator->last_login_at))->diffForHumans() }}
                         @else
                         {{ \Carbon\Carbon::createFromTimeStamp(strtotime($moderator->created_at))->diffForHumans() }}
                         @endif
                        </div>
                        <ul class="list-inline">
                            @if ($moderator->profile->orcid)
                             <a href="https://orcid.org/{{ $moderator->profile->orcid }}" target="_blank">
                                <i class="ai ai-orcid"></i></a></li>
                            @endif
                            
                             @if ($moderator->profile->twitter_username)
                             <li><a href="https://twitter.com/{{ $moderator->profile->twitter_username }}" target="_blank">
                                <i class="fa fa-twitter"> </i></a></li>
                            @endif

                            @if ($moderator->profile->github_username)
                             <li><a href="https://github.com/{{ $moderator->profile->github_username }}" target="_blank">
                                <i class="fa fa-github"> </i></a></li>
                            @endif

                            @if ($moderator->profile->linkedin_username)
                             <li><a href="{{ $moderator->profile->linkedin_username }}" target="_blank">
                                <i class="fa fa-linkedin"> </i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            @endforeach             
        
        </div>
         {{ $moderators->links() }}
        <br><br>     
</div>

@endsection

