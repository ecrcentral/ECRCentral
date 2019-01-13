@extends('layouts.app')

@section('template_title')
  Community
@endsection

@section('template_linked_css')

<style type="text/css">
    .card {
    border: none;
    background: #edf0f1;
}
.joined_date {
    font-size: 10px;
    color: #edf0f1;
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
                <h3 class="page-header">Community<small>members</small></h3>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            
            @foreach($users as $user)

               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center">
                <div class="thumbnail">
                    <img src="@if ($user->profile->avatar_status == 1) /storage/{{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}"  width="100" height="100" border="0" class="img-circle">
                    <div class="caption">
                        <b><a href="/profile/{{ $user->name }}">{{ $user->name }}</a> </b>
                       
                        @if ($user->profile->organization)
                        <div class="organization">{{ $user->profile->organization }}</div>
                        @endif
                        <div class="joined_date">Joined: {{ $user->created_at->format('M d, Y') }}</div>
                        <ul class="list-inline">
                            @if ($user->profile->orcid)
                             <a href="https://orcid.org/{{ $user->profile->orcid }}" target="_blank">
                                <i class="ai ai-orcid"></i>
                             </a></li>
                            @endif
                            
                             @if ($user->profile->twitter_username)
                             <li><a href="https://twitter.com/{{ $user->profile->twitter_username }}" target="_blank">
                                <i class="fa fa-twitter"> </i>
                             </a></li>
                            @endif

                            @if ($user->profile->github_username)
                             <li><a href="https://github.com/{{ $user->profile->github_username }}" target="_blank">
                                <i class="fa fa-github"> </i>
                             </a></li>
                            @endif

                            @if ($user->profile->linkedin_username)
                             <li><a href="{{ $user->profile->linkedin_username }}" target="_blank">
                                <i class="fa fa-linkedin"> </i>
                             </a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            @endforeach             
        
        </div>
         {{ $users->links() }}
        <br><br>     
</div>

@endsection

