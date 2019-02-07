        <!-- Twitter and Facebook card-->
        <meta property="og:type" content="article" />
        <meta property="og:title" content="@if(trim($__env->yieldContent('og_title')))@yield('og_title') @else{{ setting('site.title') }}@endif" />
        <meta property="og:url" content="@if(trim($__env->yieldContent('description')))@yield('description')@else
https://ecrcentral.org/@endif" />
        @if(trim($__env->yieldContent('description')))
        <meta name="description" content="@yield('description')"/>
        <meta property="og:description" content="@yield('description')"/>
        @else
        <meta name="description" content="{{ setting('site.description') }}"/>
        <meta property="og:description" content="{{ setting('site.description') }}"/>
        @endif
        
        @if(trim($__env->yieldContent('published_time')))<meta property="article:published_time" content="@yield('published_time')"/> @endif

        @if(trim($__env->yieldContent('modified_time')))<meta property="article:modified_time" content="@yield('modified_time')" /> @endif

        <meta property="og:site_name" content="ECRcentral" />
        <meta property="og:locale" content="en_US" />
        <meta name="twitter:creator" content="@khanaziz84" />
        <meta name="twitter:site" content="@ECRcentral" />
        <meta name="twitter:text:title" content="@if(trim($__env->yieldContent('og_title')))@yield('og_title')@else
{{ setting('site.title') }}@endif" />
        @if(trim($__env->yieldContent('card_summary')))
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:image" content="{{url('/')}}/storage/{{ setting('site.summary_image_large') }}" />
        <meta name="og:image" content="{{url('/')}}/storage/{{ setting('site.summary_image_large') }}" />
        @else
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:image" content="{{url('/')}}/storage/{{ setting('site.summary_image') }}" />
        <meta name="og:image" content="{{url('/')}}/storage/{{ setting('site.summary_image_large') }}" />
        @endif