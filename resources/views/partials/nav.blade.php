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
                <li {{ Route::is('fundings') ? 'class=active' : null }}><a href="{{ route('fundings') }}">Fundings</a></li>
                <li {{ Request::is('travel-grants') ? 'class=active' : null }}><a href="{{ url('/travel-grants') }}">Travel Grants</a></li>
                <li {{ Request::is('forums') ? 'class=active' : null }}><a href="/forums">Forums</a></li>
                <li {{ Request::is('blog') ? 'class=active' : null }}> <a href="/blog">Blog</a></li>
                <li {{ Route::is('about') ? 'class=active' : null }}><a href="{{ route('about') }}">About</a></li>

                <!--
                <li class="dropdown" {{ Request::is('about') ? 'class=active' : null }}>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">About</a>
                  <span class="dropdown-arrow"></span>
                  <ul class="dropdown-menu">
                    <li><a href="/about">About</a></li>
                    <li><a href="/team">Team</a></li>
         
                  </ul>
                </li>
            -->
            </ul>
             

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- Authentication Links --}}
                @if (Auth::guest())
                    <li {{ Request::is('login') ? 'class=active' : null }}><a href="{{ route('login') }}">{!! trans('titles.login') !!}</a></li>
                    <li {{ Request::is('register') ? 'class=active' : null }}><a href="{{ route('register') }}">{!! trans('titles.register') !!}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'class=active' : null }}>
                                {!! HTML::link(url('/profile/'.Auth::user()->name), trans('titles.profile')) !!}
                            </li>

                            @if(Auth::user() && Auth::user()->role->name != 'user')
                
                                <li>{!! HTML::link(url('/admin'), 'Administration Panel') !!}</li>

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
