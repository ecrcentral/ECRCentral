@extends('layouts.app')

@section('template_title')
ECR Community
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
                <h3 class="page-header">Community<small>members</small></h3>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            
            @foreach($members as $member)

            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center">
                <div class="thumbnail">
                    <img src="@if ($member->profile->avatar_status == 1)/storage/{{ $member->avatar }} @else {{ Gravatar::get($member->email) }} @endif" alt="{{ $member->name }}"  width="100" height="100" border="0" class="img-circle">
                    <div class="caption">
                        <a href="/profile/{{ $member->name }}">@if ($member->first_name && $member->last_name) {{ $member->first_name }} {{ $member->last_name }} @else {{ $member->name }} @endif</a>
                        @if ($member->profile->organization)
                        <div class="organization">{{ $member->profile->organization }}</div>
                        @endif
                        <div class="joined_date">Joined: {{ $member->created_at->format('M d, Y') }}</div>
                        <ul class="list-inline">
                            @if ($member->profile->orcid)
                             <a href="https://orcid.org/{{ $member->profile->orcid }}" target="_blank">
                                <i class="ai ai-orcid"></i></a></li>
                            @endif
                            
                             @if ($member->profile->twitter_username)
                             <li><a href="https://twitter.com/{{ $member->profile->twitter_username }}" target="_blank">
                                <i class="fa fa-twitter"> </i></a></li>
                            @endif

                            @if ($member->profile->github_username)
                             <li><a href="https://github.com/{{ $member->profile->github_username }}" target="_blank">
                                <i class="fa fa-github"> </i></a></li>
                            @endif

                            @if ($member->profile->linkedin_username)
                             <li><a href="{{ $member->profile->linkedin_username }}" target="_blank">
                                <i class="fa fa-linkedin"> </i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            @endforeach             
        
        </div>
         {{ $members->links() }}
        <br><br>     
</div>

@endsection

