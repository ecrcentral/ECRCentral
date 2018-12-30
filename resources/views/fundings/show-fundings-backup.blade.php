@extends('layouts.app')

@section('template_title')
   Funding schemes for postdoctoral fellowships
@endsection

@section('template_linked_css')

@endsection

@section('content')
<div class="container">

<div class="row">
    <!-- BEGIN SEARCH RESULT -->
    <div class="col-md-12">
        <div class="grid search">
            <div class="grid-body">
                <div class="row">

                    <div class="col-md-12">
                      <h4 class="page-header"><i class="fa fa-certificate"></i> Funding schemes and fellowships for early career researchers

                      <div class="pull-right">
                      <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('fundings/create') }}" data-toggle="tooltip" title="Add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add fundings
                      </a>                                     
                  </div></h4>
                       
                        <!-- BEGIN SEARCH INPUT -->
                     {{ Form::open(array('route' => 'fundings', 'method' => 'get', 'class'=> 'form-horizontal' )) }}
                        
                        <div class="row">

                          <!--                         
                          <div class="col-lg-2">
                            <div class="input-group input-group-lg">
                                <label></label>
                              <select name="subjects" id="subjects" class="form-control" width="100%">
                                  <option value="">Subjects</option>
                                  @foreach ($subjects as $subject)
                                  <option value="{{ $subject->id }}">{{ $subject->name }} </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                       
                        <div class="col-md-2">
                            <div class="input-group input-group-lg">
                                 <label></label>
                              <select name="host_country" id="host_country" class="form-control" width="100%">
                                  <option value="">Host country </option>
                                  @foreach ($host_countries as $host_country)
                                  <option value="{{ $host_country->host_country }}" {{ (Request::get('host_country') == $host_country->host_country ? "selected":"") }}>{{ $host_country->host_country }} </option>

                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="input-group input-group-lg">
                                 <label></label>
                              <select name="applicant_country" id="applicant_country" class="form-control" width="100%">
                                  <option value="">Applicant country </option>
                                  @foreach ($applicant_countries as $applicant_country)
                                  <option value="{{ $applicant_country->applicant_country }}" {{ (Request::get('applicant_country') == $applicant_country->applicant_country ? "selected":"") }}>{{ $applicant_country->applicant_country }} </option>

                                  @endforeach
                              </select>
                            </div>
                          </div>
                           -->
                           <div class="col-md-12">
                                <div class="input-group input-group-lg">
                                    <label></label>
                                <input type="text" id="search-funding" value="{{ Request::get('q') }}" class="form-control" autocomplete="off" name="q" placeholder="Search funding opportunities..." data-toggle="tooltip" data-placement="bottom" title="You can search by any other keyword."/> <span class="input-group-btn">
                                <button class="btn btn-default btn-flat" type="submit">Search <i class="fa fa-search"></i></button>
                                </span>
                                </div>
                            </div>
                          
                        </div><!-- /.row -->                        
                                
                    {{ Form::close() }}

                        <!-- END SEARCH INPUT -->
                        <p></p>
                        
                        <div class="padding"></div>
                        <!--
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        Order by <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Name</a></li>
                                        <li><a href="#">Deadline</a></li>
                                        <li><a href="#">Country</a></li>
                                    </ul>
                                </div>
                            </div>                            
                            <div class="col-md-6 text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default active"><i class="fa fa-list"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-th"></i></button>
                                </div>
                            </div>
                        </div>
                    -->
                        <div class="padding"></div>
                        
                        <!-- BEGIN TABLE RESULT -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>

                                    @foreach($fundings as $funding)
                                        <tr>
                                            <td><strong><a href="{{ route('fundings') }}/@if($funding->slug){{$funding->slug}}@else{{$funding->id}}@endif">{{$funding->name}}</a></strong><br>
                                            {{$funding->funder_name}}</td>
                                            <td class="hidden-xs"><small>Applicant Nationality: <b>{{ $funding->applicant_country}}</b><br>
                                            Host country: <b>{{ $funding->host_country }}</b></small></td>

                                           @if(Auth::user() && Auth::user()->role->name == 'admin')
                                            <td>
                                                {!! Form::open(array('url' => 'fundings/' . $funding->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete funding', 'data-message' => 'Are you sure you want to delete this funding ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @endif
                                          @if(Auth::user() && Auth::user()->role->name != 'user')
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/fundings/' . $funding->id . '/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                          @endif
                                         
                                        </tr>
                                    @endforeach
                               
                            
                            </tbody></table>
                        </div>
                        {{ $fundings->links() }}
                        <!--
                      <div id="disqus_thread"></div>
                    -->
                        
                    </div>
                    <!-- END RESULT -->
                </div>
            </div>
        </div>
    </div>
    <!-- END SEARCH RESULT -->
</div>
</div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    {{--
        @include('scripts.tooltips')
    --}}

@endsection

@section('js')

@endsection

