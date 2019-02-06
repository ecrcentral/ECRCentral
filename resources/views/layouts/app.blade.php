@if( Request::is( Config::get('chatter.routes.home')) )
    <title>Early career researchers community forum -  {{ config('app.name') }} </title>
@elseif( Request::is( Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.category') . '/*' ) && isset( $discussion ) )
    <title>{{ $discussion->category->name }} - {{ config('app.name') }}</title>
@elseif( Request::is( Config::get('chatter.routes.home') . '/*' ) && isset($discussion->title))
    <title>{{ $discussion->title }} - {{ config('app.name') }}</title>
@endif

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="adaAvTZotNCGfeegU4tLnnInW2O1X4MTiTV2s8dkrLY" />

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="ECRcentral is a central platform for early career researchers to find postdoc research fellowships, travel grants and to share experiences and to provide feedback."/>
        <meta name="keywords" content="funding, opportunities, Postdoc, fellowships, schemes, early career researchers, ECR, postdoctoral, forum, research, grants, travel, conference, resource, PhD"/>
        <meta name="author" content="Aziz Khan">
        @include('partials.favicon')
        
        @yield('socials_card')
        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        {{-- Fonts --}}
        @yield('template_linked_fonts')
        {{-- Styles --}}
        <link href="{{ asset('css/ecrcentral.css') }}" rel="stylesheet">
        
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.rawgit.com/jpswalsh/academicons/master/css/academicons.min.css">


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
        <link href="{{ asset('css/flat-ui.min.css') }}" rel="stylesheet">
        @endif


        @yield('head')

        @yield('css')

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
        <script>
        window.addEventListener("load", function(){
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#BDC3C7",
              "text": "#000"
            },
            "button": {
              "background": "#19b491",
              "text": "#ffffff"
            }
          },
          "theme": "classic",
          "position": "bottom-left",
          "content": {
            "message": "This site uses cookies to deliver its services and analyse traffic. By using this site, you agree to its use of cookies.",
            "dismiss": "GOT IT",
            "link": "Learn more",
            "href": "https://ecrcentral.org/privacy"
          }
        })});
        </script>

    </head>
    <body data-spy="scroll" data-offset="0">
      <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "WebSite",
          "name": "ECRcentral",
          "url": "https://ecrcentral.org",
          "logo": "https://ecrcentral.org/images/logo.png",
          "license": "CC BY 4.0",
          "description": "ECRcentral is a central platform for early career researchers to find postdoc research fellowships, travel grants and to share experiences and to provide feedback.",
          "version": "2019",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://ecrcentral.org/fundings?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
        </script>

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
        <script src="{{ asset('js/avatar-initial.js') }}"></script>
  
        <script src="{{ asset('js/flat-ui.js') }}"></script>

        @if(config('settings.googleMapsAPIStatus'))
            {!! HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
        @endif

        @yield('footer_scripts')
        @yield('js')

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113439387-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-113439387-1');
        </script>
    </body>
</html>
