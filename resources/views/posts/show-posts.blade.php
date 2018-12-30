@extends('layouts.app')

@section('template_title')
   Early career researchers blog
@endsection

@section('template_linked_css')

@endsection

@section('content')
<!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Blog<small> by early career researchers for early career researchers</small></h3>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                    @foreach($posts as $post)
                    <div class="col-md-6">
                      <div class="owl-carousel">
                          <div class="post-slide">
                              <div class="post-img">
                                @if($post->image)
                                  <img class="img-responsive" src="/storage/{{$post->thumbnail('medium')}}" alt="">
                                  @endif
                                  <div class="over-layer">
                                      <ul class="post-link">
                                          <li>
                                              <a href="blog/{{$post->slug}}" class="fa fa-link"></a>
                                          </li>
                                      </ul>
                                  </div>
                                  <div class="post-date">
                                      <span class="date">{{$post->created_at->format('d')}}</span>
                                      <span class="month">{{$post->created_at->format('F')}}</span>
                                  </div>
                              </div>
                              <div class="post-content">
                                  <h3 class="post-title">
                                      <a href="blog/{{$post->slug}}">{{$post->title}}</a>
                                  </h3>
                                  <p class="post-description">{{$post->excerpt}}</p>
                                  <a href="blog/{{$post->slug}}" class="read-more">>Read more</a>
                              </div>
                          </div>
                      </div>
                    </div>
                    @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                  {{ Form::open(array('route' => 'posts', 'method' => 'get')) }}
                    <div class="input-group">
                        <input type="text" name="q" value="{{ Request::get('q') }}" placeholder="Search blog..." class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    {{ Form::close() }}
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h6> Categories</h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                              @foreach($categories as $category)
                                <li><a href="#">{{ $category->name}}</a></li>
                              @endforeach
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h6>Contribute</h6>
                    <p>If you would like to contribute to the blog, please feel free to contact the team.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <!-- /.container -->

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}
@endsection