@extends('layouts.app')

@section('template_title')
  Travel Grants for PhDs, Postdocs and ECRs
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
                    
                    <div class="col-md-12">
                        <h4 class="page-header"><i class="fa fa-plane"></i> Travel grants for early career researchers
                         <div class="pull-right">
                      <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('travel-grants/create') }}" data-toggle="tooltip" title="Add"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add travel grants
                      </a>                                     
                  </div>
              </h4>
                        <!-- BEGIN SEARCH INPUT -->
                     {{ Form::open(array('route' => 'travelgrants', 'method' => 'get')) }}
                        <div class="input-group input-group-lg">
                        <input type="text" id="search-travelgrant" value="{{ Request::get('q') }}" class="form-control" autocomplete="off" name="q" placeholder="Search travel grants..." data-toggle="tooltip" data-placement="bottom" title="You can search by any other keyword."/>
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Search <i class="fa fa-search"></i></button>
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
                                            <td><strong><a href="{{ route('travelgrants') }}/@if($travelgrant->slug){{$travelgrant->slug}}@else{{$travelgrant->id}}@endif">{{$travelgrant->name}}</a></strong><br>
                                            {{$travelgrant->funder_name}}</td>
                                            <td class="hidden-xs"><small> Subjects: <b>{{ $travelgrant->fields}} </b></small><br>

                                           
                                            @if(Auth::user() && Auth::user()->role->name == 'admin')
                                            <td>
                                                {!! Form::open(array('url' => 'travel-grants/' . $travelgrant->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete travel grant', 'data-message' => 'Are you sure you want to delete this travelgrant ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @endif

                                            @if(Auth::user() && Auth::user()->role->name != 'user')
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/travel-grants/' . $travelgrant->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                               
                            
                            </tbody></table>
                        </div>
                        {{ $travelgrants->links() }}

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
