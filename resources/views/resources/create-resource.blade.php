@extends('layouts.app')

@section('template_title')
  Add New Resource
@endsection

@section('template_fastload_css')
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <h4 class="page-header"><i class="fa fa-plus"></i> Add new Resource
            <a href="{{ route('resources') }}" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              Back <span class="hidden-md">to</span><span class="hidden-md"> Resources</span>
            </a>
          </h4>

        <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <small>
          We encourage the community to help to add new resources using below form, which will be reviewed and added to the travel grants list. <br>Please add resources which are not in the above list and we only accept submissions in English. Thanks for your contributions!
        </small>
       </div>
            
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">

            {!! Form::open(array( 'route'=>'resources.store', 'method'=> 'POST')) !!} 


            {{ csrf_field() }}

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Add resource name')) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                {!! Form::label('description', 'Description' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Add resource description')) !!}
                    <label class="input-group-addon" for="description"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('source_name') ? ' has-error ' : '' }}">
                {!! Form::label('source_name', 'Source name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('source_name', old('source_name'), array('id' => 'source_name', 'class' => 'form-control', 'placeholder' => 'Add source/author name')) !!}
                    <label class="input-group-addon" for="source_name"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('url') ? ' has-error ' : '' }}">
                {!! Form::label('url', 'Resource URL' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('url', old('url'), array('id' => 'url', 'class' => 'form-control', 'placeholder' => 'Add website URL')) !!}
                    <label class="input-group-addon" for="url"><i class="fa fa-fw fa-link " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

              <div class="form-group has-feedback row {{ $errors->has('categories') ? ' has-error ' : '' }}">
                {!! Form::label('categories', 'Resource categories' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">

                    @foreach($categories as $category)
                    <label>{!! Form::checkbox('categories[]', $category->id, null,  ['id' => 'categories']) !!} {!! $category->name !!} </label>
                    &nbsp;&nbsp;
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('published_at') ? ' has-error ' : '' }}">
                {!! Form::label('published_at', 'Published date' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('published_at', old('published_at'), array('id' => 'published_at', 'class' => 'form-control', 'placeholder' => 'YYYY-MM-DD')) !!}
                    <label class="input-group-addon" for="published_at"><i class="fa fa-calander " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

               <div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }}">
                {!! Form::label('status', 'Resource status' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    <select class="form-control" name="status">
                      <option value="0" selected>Draft</option>
                      @if(Auth::user() && Auth::user()->role->name != 'user')
                      <option value="1">Publish</option>
                       @endif
                    </select>
                  </div>
                </div>
              </div>
              
              {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Submit Resource', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('footer_scripts')
@endsection
