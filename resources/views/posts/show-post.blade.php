@extends('layouts.app')

@section('template_title')
  {{ $post->title }}
@endsection

@section('template_linked_css')

@endsection


@section('content')

<!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">{{ $post->title }}</h3>        
            </div>
        </dsiv>
            

        <!-- Content Row -->
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Date/Time -->
                <p><small><i class="fa fa-clock-o"></i> Posted in  <b>{{$post->category->name }} </b> category on <i>{{$post->created_at->format('F d, Y')}} </i>  by <a href="/profile/{{$post->authorId['name']}}"> <b>{{$post->authorId['name']}}</b></a>

                  @if(Auth::user() && Auth::user()->role->id == '1')
                  | 
                <a class="txt-info" target="_blank" href="{{ URL::to('/admin/posts/' . $post->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit
                </a>                                     
            @endif
                </small></p>

                <hr>

                <!-- Preview Image -->
                @if($post->image)
                <img class="img-responsive" src="/storage/{{ $post->image }}" alt="">
                <hr>
                 @endif

                  <a href="https://twitter.com/intent/tweet?text={{$post->title}}&amp;url={{ urlencode(Request::fullUrl()) }}&amp;via=ecrcentral" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  <a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-google"><i class="fa fa-google" aria-hidden="true"></i></a>
                  <a href="http://www.linkedin.com/shareArticle?url={{ urlencode(Request::fullUrl()) }}" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                  <a href="mailto:?Subject={{$post->title}}&Body={{ urlencode(Request::fullUrl()) }}" target="_blank" class="btn btn-social-icon btn-sm margin-half btn-github"><i class="fa fa-envelope" aria-hidden="true"></i></a>

  
                <!-- Post Content -->
                <p>{!! $post->body !!}</p>

                <hr>
                <div id="disqus_thread"> </div>
                
            </div>
     
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Recent posts</h4>
                    <ul class="list-unstyled">

                      @foreach($recent_posts as $recent_post)
                      <li><a href="/blog/{{$post->slug}}">{{$post->title}}</a></li>
                      @endforeach
                    </ul>
                </div>

            </div>

        </div>
        <!-- /.row -->

 </div>

@endsection
@section('footer_scripts')

@endsection
