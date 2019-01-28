@extends('layouts.app')

@section('template_title')
  Add New Travel Grant
@endsection

@section('template_fastload_css')
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <h4 class="page-header"><i class="fa fa-plus"></i> Add new travel grant
            <a href="/travel-grants" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              Back <span class="hidden-md">to</span><span class="hidden-md"> Travel Grants</span>
            </a>
          </h4>

        <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <small>
          We encourage the community to help to add new travel grants using below form, which will be reviewed and added to the travel grants list. <br>Please add travel grants which are not in the above list and we only accept submissions in English. Thanks for your contributions!
        </small>
       </div>
            
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">

            {!! Form::open(array( 'route'=>'travelgrants.store', 'method'=> 'POST')) !!} 


            {{ csrf_field() }}

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Add travel grant name')) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                {!! Form::label('description', 'Description' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Add a short description')) !!}
                    <label class="input-group-addon" for="description"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('funder_name') ? ' has-error ' : '' }}">
                {!! Form::label('funder_name', 'Funder name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('funder_name', old('funder_name'), array('id' => 'funder_name', 'class' => 'form-control', 'placeholder' => 'Funder name')) !!}
                    <label class="input-group-addon" for="funder_name"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('url') ? ' has-error ' : '' }}">
                {!! Form::label('url', 'Grant URL' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('url', old('url'), array('id' => 'url', 'class' => 'form-control', 'placeholder' => 'Grant URL')) !!}
                    <label class="input-group-addon" for="url"><i class="fa fa-fw fa-link " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

              <div class="form-group has-feedback row {{ $errors->has('purposes') ? ' has-error ' : '' }}">
                {!! Form::label('purposes', 'Grant purpose' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">

                    @foreach($purposes as $purpose)
                    <label>{!! Form::checkbox('purposes[]', $purpose->id, null,  ['id' => 'purposes']) !!} {!! $purpose->name !!} </label>
                    &nbsp;&nbsp;
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('applicant_country') ? ' has-error ' : '' }}">
                {!! Form::label('applicant_country', 'Applicant country' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('applicant_country', old('applicant_country'), array('id' => 'applicant_country', 'class' => 'form-control', 'placeholder' => 'Applicant country')) !!}
                    <label class="input-group-addon" for="applicant_country"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('membership') ? ' has-error ' : '' }}">
                {!! Form::label('membership', 'Memberschip required?' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('membership', old('membership'), array('id' => 'membership', 'class' => 'form-control', 'placeholder' => 'Memberschip required?')) !!}
                    <label class="input-group-addon" for="membership"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('membership') ? ' has-error ' : '' }}">
                {!! Form::label('membership', 'Memberschip required?' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                  <label class="radio-inline"><input type="radio"  class='form-control' value="1" name="membership"> Yes</label>
                  <label class="radio-inline"><input type="radio" class='form-control' value="0" name="membership"> No</label>
                </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('membership_time') ? ' has-error ' : '' }}">
                {!! Form::label('membership_time', 'Minimum time of membership' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('membership_time', old('membership_time'), array('id' => 'membership_time', 'class' => 'form-control', 'placeholder' => 'Minimum time of membership')) !!}
                    <label class="input-group-addon" for="membership_time"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

              <div class="form-group has-feedback row {{ $errors->has('fields') ? ' has-error ' : '' }}">
                {!! Form::label('fields', 'Subjects' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('fields', old('fields'), array('id' => 'fields', 'class' => 'form-control', 'placeholder' => 'Subjects')) !!}
                    <label class="input-group-addon" for="fields"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>
              
              <div class="form-group has-feedback row {{ $errors->has('award') ? ' has-error ' : '' }}">
                {!! Form::label('award', 'Award' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('award', old('award'), array('id' => 'award', 'class' => 'form-control', 'placeholder' => 'Award')) !!}
                    <label class="input-group-addon" for="award"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

               <div class="form-group has-feedback row {{ $errors->has('career_level') ? ' has-error ' : '' }}">
                {!! Form::label('career_level', 'Career level' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('career_level', old('career_level'), array('id' => 'career_level', 'class' => 'form-control', 'placeholder' => 'Career level')) !!}
                    <label class="input-group-addon" for="career_level"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>
              
              <div class="form-group has-feedback row {{ $errors->has('deadline') ? ' has-error ' : '' }}">
                {!! Form::label('deadline', 'Application deadline' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('deadline', old('deadline'), array('id' => 'deadline', 'class' => 'form-control', 'placeholder' => 'Application deadline')) !!}
                    <label class="input-group-addon" for="deadline"><i class="fa fa-fw fa-calander " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('comments') ? ' has-error ' : '' }}">
                {!! Form::label('comments', 'Additional comments' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('comments', old('comments'), array('id' => 'comments', 'class' => 'form-control', 'placeholder' => 'Additional comments')) !!}
                    <label class="input-group-addon" for="comments"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

               <div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }}">
                {!! Form::label('status', 'Status' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    <select class="form-control" name="status" @if(Auth::user() && Auth::user()->role->name != 'user') @else disabled @endif>
                      <option value="1">Publish</option>
                      <option value="0" selected>Draft</option>
                    </select>
                  </div>
                </div>
              </div>
        
              {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Submit travel grant', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('footer_scripts')
@endsection
