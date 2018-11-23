@extends('layouts.app')

@section('template_title')
  Showing fundings
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
                    <!-- BEGIN FILTERS -->
                     <!--
                    <div class="col-md-1">
                    
                   
                        <div class="padding"></div>
                       
                        <div class="todo">
                            <div class="todo-search">
                              <input class="todo-search-field" type="text" name="q" value="" placeholder="Search" />
                            </div>
                            <ul>
                              <li class="todo-done">
                                <div class="todo-icon fui-user"></div>
                                <div class="todo-content">
                                  <h4 class="todo-name">
                                    Meet <strong>Adrian</strong> at <strong>6pm</strong>
                                  </h4>
                                </div>
                              </li>
                              <li>
                                <div class="todo-icon fui-list"></div>
                                <div class="todo-content">
                                  <h4 class="todo-name">
                                    Chat with <strong>V.Kudinov</strong>
                                  </h4>
                                  Skype conference an 9 am
                                </div>
                              </li>
                              <li>
                                <div class="todo-icon fui-eye"></div>
                                <div class="todo-content">
                                  <h4 class="todo-name">
                                    Watch <strong>Iron Man</strong>
                                  </h4>
                                  1998 Broadway
                                </div>
                              </li>
                              <li>
                                <div class="todo-icon fui-time"></div>
                                <div class="todo-content">
                                  <h4 class="todo-name">
                                    Fix bug on a <strong>Website</strong>
                                  </h4>
                                  As soon as possible
                                </div>
                              </li>
                            </ul>
                          </div>
                    
                       
                    </div>  -->

                    <div class="col-md-12">
                        <h3><i class="fa fa-search-o"></i> Funding schemes for postdoctoral fellowships</h3>
                        <hr>
                        <!-- BEGIN SEARCH INPUT -->
                     {{ Form::open(array('route' => 'fundings', 'method' => 'get', 'class'=> 'form-horizontal' )) }}
                        
                        <div class="row">
                            <div class="col-lg-2">
                            <div class="input-group input-group-lg">
                                 <label></label>
                              <select name="phd" id="phd" class="form-control" width="100%">
                                  <option value="1">Years since PhD </option>
                                  @foreach ($years_since_phd as $year_since_phd)
                                  <option value="{{ $year_since_phd->years_since_phd }}">{{ $year_since_phd->years_since_phd }} </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <div class="input-group input-group-lg">
                                 <label></label>
                              <select name="applicant" id="applicant" class="form-control">
                                  <option value="">Applicant country </option>
                                  @foreach ($applicant_countries as $applicant_country)
                                  <option value="{{ $applicant_country->applicant_country }}">{{ $applicant_country->applicant_country }} </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <div class="input-group input-group-lg">
                                 <label></label>
                              <select name="host" id="host" class="form-control" width="100%">
                                  <option value="">Host country </option>
                                  @foreach ($host_countries as $host_country)
                                  <option value="{{ $host_country->host_country }}">{{ $host_country->host_country }} </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
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
                           <div class="col-lg-4">
                                <div class="input-group input-group-lg">
                                    <label></label>
                                <input type="text" id="search-funding" value="{{ Request::get('q') }}" class="form-control" autocomplete="off" name="q" placeholder="Keyword(s) ..." data-toggle="tooltip" data-placement="bottom" title="You can search by any other keyword."/> <span class="input-group-btn">
                                <button class="btn btn-primary btn-flat" type="submit">Search <i class="fa fa-search"></i></button>
                                </span>
                                </div>
                            </div>
                          
                        </div><!-- /.row -->
                        <hr>
                        
                                
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
                                            <td><strong><a href="{{ route('fundings') }}/{{$funding->id}}">{{$funding->name}}</a></strong><br>
                                            {{$funding->funder_name}}</td>
                                            <td class="hidden-xs">Applicant: {{ $funding->applicant_country}}<br>
                                            Host: {{ $funding->host_country }}</td>

                                           
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('fundings/' . $funding->id) }}" data-toggle="tooltip" title="Show">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('fundings/' . $funding->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                               
                            
                            </tbody></table>
                        </div>
                        {{ $fundings->links() }}
                        
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
