<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


<style type="text/css">
            body { padding-top: 40px; }

#container {

    padding-top: 40px;
}


/* ==========================================================================
   Wrap Sections
   ========================================================================== */

#headerwrap {
    background-color: #34495e;
    padding-top: 10px;
}

#headerwrap h1 {
    margin-top: 30px;
    color: white;
    font-size: 70px;
    
}

#headerwrap h3 {
    color: white;
    font-size: 30px;
    line-height: 40px;
}

#headerwrap h5 {
    color: white;
    font-weight: 700;
    text-align: left;
}

#headerwrap p {
    text-align: left;
    color: white
}

/* intro Wrap */

#intro {
    padding-top: 50px;
    border-top: #c1652b solid 5px;
}

#page-header {
    background-color: #38495c;
    padding-top: 50px;
    padding-bottom: 10px;
    text-align: center;
}
#page-header h3 {
    color: white;
    text-align: center;
}

#upcoming {
    background-color: #19b491;
    padding-top: 50px;
    padding-bottom: 50px;
}
#upcoming h3 {
    color: white;
}

#features {
    padding-top: 50px;
    padding-bottom: 50px;
}

#features .ac a{
    font-size: 20px;
}

/* Showcase Wrap */

#showcase {
    display: block;
    background-color: #34495e;
    padding-top: 50px;
    padding-bottom: 50px;
}

#showcase h1 {
    color: white;
}

#footerwrap {
    background-color: #2f2f2f;
    color: white;
    padding-top: 40px;
    padding-bottom: 60px;
    text-align: left;
}

#footerwrap h3 {
    font-size: 28px;
    color: white;
}

#footerwrap p {
    color: white;
    font-size: 18px;
}

/* Copyright Wrap */

#c {
    background: #222222;
    padding-top: 15px;
    text-align: center;
}

#c p {
    color: white
}

h3.feature-title {
    color: #329ef4;
}
ol.features {
    padding: 0px;
}
ol.features li {
    margin-bottom: 15px;
    padding-left: 5px;
}
.contact-link {
    margin-bottom: 10px;
}
.contact-link i {
    margin-right: 7px;
}
        </style>

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="Aziz han">
        <link rel="shortcut icon" href="/favicon.ico">

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')

            @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
                .user-avatar-nav {
                    background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
                    background-size: auto 100%;
                }
            @endif

        </style>

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @if (Auth::User() && (Auth::User()->profile) && $theme->link != null && $theme->link != 'null')
            <link rel="stylesheet" type="text/css" href="{{ $theme->link }}">
        @else
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css">
        
        @endif


        @yield('head')

        @yield('css')

    </head>
    <body data-spy="scroll" data-offset="0">

        <div id="app">

            @include('partials.nav')

            <div class="container">

                @include('partials.form-status')

            </div>

            @yield('content')

        </div>

        @include('partials.footer')


        {{-- Scripts --}}
        <script src="{{ mix('/js/app.js') }}"></script>

        @if(config('settings.googleMapsAPIStatus'))
            {!! HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
        @endif

        @yield('footer_scripts')
        @yield('js')

    </body>
</html>
