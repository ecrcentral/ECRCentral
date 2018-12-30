@extends('layouts.app')

@section('template_title')
   ERC Blog
@endsection

@section('template_linked_css')

@endsection

@section('content')
<!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">ecrBlog<small> by ECRs for ECRs</small></h3>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- First Blog Post -->
                  @foreach($posts as $post)
                        <h4>
                            <a href="blog/{{$post->slug}}">{{$post->title}}</a>
                        </h4>
                        <p><i class="fa fa-clock-o"></i> Posted on <b> {{$post->created_at->format('F d, Y')}} </b> by <a href="profile/{{$post->authorId['name']}}"> <b>{{$post->authorId['name']}}</b></a> </p>
                        <hr>
                         @if($post->image)
                          <img class="img-responsive" src="/storage/{{ $post->image }}" alt="">
                          <hr>
                          @endif
                        <p>{{$post->excerpt}}</p>
                        <a class="btn btn-primary" href="blog/{{$post->slug}}">Read More <i class="fa fa-angle-right"></i></a>

                        <hr>
                    @endforeach
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

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