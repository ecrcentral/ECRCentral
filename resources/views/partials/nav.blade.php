<nav class="navbar navbar-default navbar-fixed-top bg-dark">
    <div class="container">
        <div class="navbar-header">

            {{-- Collapsed Hamburger --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{-- Branding Image --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                @if(setting('site.logo'))
                <img height="100%" src="/storage/{{ setting('site.logo') }}">
                @else
                {{ setting('site.title') }}
                @endif
                
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            {{-- Left Side Of Navbar --}}
            <ul class="nav navbar-nav">
                <!--
                <li {{ Route::is('index') ? 'class=active' : null }}><a href="{{ route('index') }}">Home</a></li>
                -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Funding <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li {{ Route::is('fundings') ? 'class=active' : null }}><a href="{{ route('fundings') }}">Funding Schemes</a></li>
                    <li {{ Request::is('travel-grants') ? 'class=active' : null }}><a href="{{ route('travelgrants') }}">Travel Grants</a></li> 
                  </ul>
                </li>

                <li {{ Request::is('resources') ? 'class=active' : null }}><a href="{{ route('resources') }}">Resources</a></li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Community <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    
                    <li {{ Request::is('forums') ? 'class=active' : null }}><a href="/{{ Config::get('chatter.routes.home') }}/">Community Forum</a></li>
                    
                    <li><a href="https://ecrlife.org" target="_balank">Blog</a></li>
                    <!--
                    <li {{ Request::is('blog') ? 'class=active' : null }}> <a href="/blog">Community Blog</a></li>
                -->

                    <li role="separator" class="divider"></li>

                    <li {{ Request::is('community') ? 'class=active' : null }}><a href="/community">Members</a></li>
                    <li {{ Request::is('community/moderators') ? 'class=active' : null }}><a href="/community/moderators">Moderators</a></li>
                    <li {{ Request::is('community/managers') ? 'class=active' : null }}><a href="/community/managers">Managers</a></li>
                  </ul>
                </li>
                <!--             
                <li {{ Request::is('blog') ? 'class=active' : null }}> <a href="/blog">Blog</a></li>
            -->
               
                <li class="dropdown" {{ Request::is('about') ? 'class=active' : null }}>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret active"></span></a>

                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                    <li {{ Route::is('about') ? 'class=active' : null }}><a href="{{ route('about') }}">About ECRcentral</a></li>
                    <li {{ Route::is('team') ? 'class=active' : null }}><a href="{{ route('team') }}">Our Team</a></li>
                    <li {{ Route::is('getinvolved') ? 'class=active' : null }}><a  href="{{ route('getinvolved') }}">Get Involved</a></li>
                    
                    <li {{ Route::is('terms') ? 'class=active' : null }}><a  href="{{ route('terms') }}">Terms of Use</a></li>
                    <li {{ Route::is('privacy') ? 'class=active' : null }}><a href="{{ route('privacy') }}">Privacy Policy</a></li>         
                  </ul>
                </li>
           
            </ul>
             

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- Authentication Links --}}
                @if (Auth::guest())
                    <li {{ Request::is('login') ? 'class=active' : null }}><a href="{{ route('login') }}">{!! trans('titles.login') !!}</a></li>
                    <li {{ Request::is('register') ? 'class=active' : null }}><a href="{{ route('register') }}">{!! trans('titles.register') !!}</a></li>
                @else
                    <li class="dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                @if (Auth::User()->first_name && Auth::User()->last_name)
                                <img class="round user-avatar-nav" width="50" height="50" avatar="{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}">
                                @else
                                <img class="round user-avatar-nav" width="50" height="50" avatar="{{ Auth::User()->name }}">
                                @endif
                            <!--
                                <div class="user-avatar-nav"></div>
                            -->
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'class=active' : null }}>
                                {!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!}
                            </li>

                            @if(Auth::user() && Auth::user()->role->name != 'user')
                
                                <li>{!! HTML::link(url('/admin'), 'Administration Panel') !!}</li>

                            @endif

                            @if(Auth::user() && Auth::user()->role->name == 'admin')

                                <li {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'class=active' : null }}>{!! HTML::link(url('/users'), Lang::get('titles.adminUserList')) !!}</li>

                                <li {{ Request::is('users/create') ? 'class=active' : null }}>{!! HTML::link(url('users/create'), Lang::get('titles.adminNewUser')) !!}</li>
                                <li {{ Request::is('themes','themes/create') ? 'class=active' : null }}>{!! HTML::link(url('/themes'), Lang::get('titles.adminThemesList')) !!}</li>
                                <li {{ Request::is('logs') ? 'class=active' : null }}>{!! HTML::link(url('/logs'), Lang::get('titles.adminLogs')) !!}</li>
                                <!--
                                <li {{ Request::is('phpinfo') ? 'class=active' : null }}>{!! HTML::link(url('/phpinfo'), Lang::get('titles.adminPHP')) !!}</li>
                            -->
                                <li {{ Request::is('routes') ? 'class=active' : null }}>{!! HTML::link(url('/routes'), Lang::get('titles.adminRoutes')) !!}</li>
                                <li {{ Request::is('active-users') ? 'class=active' : null }}>{!! HTML::link(url('/active-users'), Lang::get('titles.activeUsers')) !!}</li>
                            
                            @endif
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {!! trans('titles.logout') !!}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
