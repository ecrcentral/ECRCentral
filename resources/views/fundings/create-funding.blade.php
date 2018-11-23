@extends('layouts.app')

@section('template_title')
  Create New Funding
@endsection

@section('template_fastload_css')
@endsection

@section('content')
<br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            Add New Funding

            <a href="/fundings" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              Back <span class="hidden-xs">to</span><span class="hidden-xs"> Fundings</span>
            </a>

          </div>
          <div class="panel-body">

            {!! Form::open(array('action' => 'FundingsController@create')) !!}

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Add funding name')) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('description', 'Description' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Add funding description')) !!}
                    <label class="input-group-addon" for="description"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('country') ? ' has-error ' : '' }}">
                {!! Form::label('funder_name', 'Funder name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('funder_name', old('funder_name'), array('id' => 'funder_name', 'class' => 'form-control', 'placeholder' => trans('forms.ph-fundingemail'))) !!}
                    <label class="input-group-addon" for="funder_name"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('country') ? ' has-error ' : '' }}">
                {!! Form::label('applicant_country', 'Applicant country' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('applicant_country', old('applicant_country'), array('id' => 'applicant_country', 'class' => 'form-control', 'placeholder' => trans('forms.ph-fundingemail'))) !!}
                    <label class="input-group-addon" for="applicant_country"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('host_country') ? ' has-error ' : '' }}">
                {!! Form::label('host_country', 'Host country' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('host_country', old('host_country'), array('id' => 'host_country', 'class' => 'form-control', 'placeholder' => trans('forms.ph-host_country'))) !!}
                    <label class="input-group-addon" for="host_country"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('country') ? ' has-error ' : '' }}">
                {!! Form::label('url', 'URL' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('url', old('url'), array('id' => 'url', 'class' => 'form-control', 'placeholder' => 'Website URL')) !!}
                    <label class="input-group-addon" for="funding_id"><i class="fa fa-fw fa-link " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

              <div class="form-group has-feedback row {{ $errors->has('country') ? ' has-error ' : '' }}">
                {!! Form::label('deadline', 'Deadline' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('deadline', old('deadline'), array('id' => 'deadline', 'class' => 'form-control', 'placeholder' => 'Application deadline')) !!}
                    <label class="input-group-addon" for="deadline"><i class="fa fa-fw fa-clock " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>
              

              {!! Form::button('<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Submit funding', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('footer_scripts')
@endsection
