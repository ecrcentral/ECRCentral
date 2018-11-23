@extends('layouts.app')

@section('template_title')
  Showing travelgrants
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
                        <h3><i class="fa fa-search-o"></i> Travel Grants  for postdocs</h3>
                        <hr>
                        <!-- BEGIN SEARCH INPUT -->
                     {{ Form::open(array('route' => 'travelgrants', 'method' => 'get')) }}
                        <div class="input-group input-group-lg">
                        <input type="text" id="search-travelgrant" value="{{ Request::get('q') }}" class="form-control" autocomplete="off" name="q" placeholder="Search travelgrants..." data-toggle="tooltip" data-placement="bottom" title="You can search by any other keyword."/> <span class="input-group-btn">
                        <button class="btn btn-primary btn-flat" type="submit">Search <i class="fa fa-search"></i></button>
                        </span>
                        </div>
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

                                    @foreach($travelgrants as $travelgrant)
                                        <tr>
                                            <td><strong><a href="{{ route('travelgrants') }}/{{$travelgrant->id}}">{{$travelgrant->name}}</a></strong><br>
                                            {{$travelgrant->funder_name}}</td>
                                            <td class="hidden-xs">Applicant: {{ $travelgrant->applicant_country}}<br>

                                            @if(Auth::user() && Auth::user()->role->id == '1')
                                            <td>
                                                {!! Form::open(array('url' => 'travelgrants/' . $travelgrant->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete travelgrant', 'data-message' => 'Are you sure you want to delete this travelgrant ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @endif
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('travel-grants/' . $travelgrant->id) }}" data-toggle="tooltip" title="Show">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('travel-grants/' . $travelgrant->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                               
                            
                            </tbody></table>
                        </div>
                        {{ $travelgrants->links() }}


                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Funder</th>
                                        <th>Purpose</th>
                                        <th>Applicant country</th>
                                        <th>Membership required?</th>
                                        <th>Membership time</th>
                                        <th>Award</th>
                                        <th>Subjects</th>
                                        <th>Deadline</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($travelgrants as $travelgrant)
                                        <tr>
                                            <td><a href="{{$travelgrant->url}}" target="_blank">{{$travelgrant->name}}</a></td>
                                            <td>{{$travelgrant->funder_name}}</td>
                                            <td>{{ $travelgrant->purpose}}</td>
                                            <td>{{ $travelgrant->applicant_country}}</td>
                                            <td>{{ $travelgrant->membership}}</td>
                                            <td>{{ $travelgrant->membership_time}}</td>
                                            <td>{{ $travelgrant->award}}</td>
                                            <td>{{ $travelgrant->subjects}}</td>
                                            <td>{{ $travelgrant->deadline}}</td>
                                            <td>{{ $travelgrant->comments}}</td>                                           
                                        </tr>
                                    @endforeach
                               
                            
                            </tbody></table>
                        </div>
                        
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
