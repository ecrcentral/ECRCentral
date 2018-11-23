@extends('layouts.app')

@section('template_title')
  Editing funding {{ $funding->name }}
@endsection

@section('template_linked_css')
  <style type="text/css">
    .btn-save,
    .pw-change-container {
      display: none;
    }
  </style>
@endsection

@section('content')
<br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            <strong>Editing funding:</strong> {{ $funding->name }}

            <a href="/fundings/{{$funding->id}}" class="btn btn-primary btn-xs pull-right" style="margin-left: 1em;">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
             Back  <span class="hidden-xs">to funding</span>
            </a>

            <a href="/fundings" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to </span>fundings
            </a>

          </div>

          {!! Form::model($funding, array('action' => array('FundingsController@update', $funding->id), 'method' => 'PUT')) !!}

            {!! csrf_field() !!}

            <div class="panel-body">

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Funding name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.ph-name'))) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('description', 'Funding description' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Funding description')) !!}
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


            </div>
            <div class="panel-footer">

              <div class="row">

                <div class="col-xs-6">
                  {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes', array('class' => 'btn btn-success btn-block margin-bottom-1 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                </div>
              </div>
            </div>

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-save')
  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')

@endsection