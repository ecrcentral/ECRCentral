@extends('layouts.app')

@section('template_title')
  Create New Funding
@endsection

@section('template_fastload_css')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <h4 class="page-header"><i class="fa fa-plus"></i> Add new funding
            <a href="/fundings" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              Back <span class="hidden-md">to</span><span class="hidden-md"> Funding</span>
            </a>
          </h4>

        <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <small>
          We encourage the community to help to add new funding opportunities using below form, which will be reviewed and added to funding list. <br>Please add fundings which are not in the above list and we only accept submissions in English. Thanks for your contributions!
        </small>
       </div>
            
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">

            {!! Form::open(array( 'route'=>'fundings.store', 'method'=> 'POST')) !!} 


            {{ csrf_field() }}

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', 'Name' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Add funding name')) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-pencil }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                {!! Form::label('description', 'Description' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Add funding description')) !!}
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
                {!! Form::label('url', 'Funding URL' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('url', old('url'), array('id' => 'url', 'class' => 'form-control', 'placeholder' => 'Funding URL')) !!}
                    <label class="input-group-addon" for="url"><i class="fa fa-fw fa-link " aria-hidden="true"></i></label>
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

              <div class="form-group has-feedback row {{ $errors->has('host_country') ? ' has-error ' : '' }}">
                {!! Form::label('host_country', 'Host country' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('host_country', old('host_country'), array('id' => 'host_country', 'class' => 'form-control', 'placeholder' => 'Host country')) !!}
                    <label class="input-group-addon" for="host_country"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('years_since_phd') ? ' has-error ' : '' }}">
                {!! Form::label('years_since_phd', 'Years since PhD' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('years_since_phd', old('years_since_phd'), array('id' => 'years_since_phd', 'class' => 'form-control', 'placeholder' => 'Years since PhD')) !!}
                    <label class="input-group-addon" for="years_since_phd"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('fileds') ? ' has-error ' : '' }}">
                {!! Form::label('fileds', 'Subjects' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('fileds', old('fileds'), array('id' => 'fileds', 'class' => 'form-control', 'placeholder' => 'Subjects')) !!}
                    <label class="input-group-addon" for="fileds"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

              <div class="form-group has-feedback row {{ $errors->has('duration') ? ' has-error ' : '' }}">
                {!! Form::label('duration', 'Funding duration' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('duration', old('duration'), array('id' => 'duration', 'class' => 'form-control', 'placeholder' => 'Funding duration')) !!}
                    <label class="input-group-addon" for="duration"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
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

              <div class="form-group has-feedback row {{ $errors->has('benefits') ? ' has-error ' : '' }}">
                {!! Form::label('benefits', 'Benefits' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('benefits', old('benefits'), array('id' => 'benefits', 'class' => 'form-control', 'placeholder' => 'Benefits')) !!}
                    <label class="input-group-addon" for="benefits"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

              <div class="form-group has-feedback row {{ $errors->has('mobility_rule') ? ' has-error ' : '' }}">
                {!! Form::label('mobility_rule', 'Mobility rule' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('mobility_rule', old('mobility_rule'), array('id' => 'mobility_rule', 'class' => 'form-control', 'placeholder' => 'Mobility rule')) !!}
                    <label class="input-group-addon" for="mobility_rule"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>

               <div class="form-group has-feedback row {{ $errors->has('research_costs') ? ' has-error ' : '' }}">
                {!! Form::label('research_costs', 'Research costs' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('research_costs', old('research_costs'), array('id' => 'research_costs', 'class' => 'form-control', 'placeholder' => 'Research costs')) !!}
                    <label class="input-group-addon" for="research_costs"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
                  </div>
                </div>  
              </div>


               <div class="form-group has-feedback row {{ $errors->has('diversity') ? ' has-error ' : '' }}">
                {!! Form::label('diversity', 'Diversity' , array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('diversity', old('diversity'), array('id' => 'diversity', 'class' => 'form-control', 'placeholder' => 'Diversity')) !!}
                    <label class="input-group-addon" for="diversity"><i class="fa fa-fw fa-pencil " aria-hidden="true"></i></label>
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
        
        

              {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Submit funding', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('footer_scripts')
@endsection
