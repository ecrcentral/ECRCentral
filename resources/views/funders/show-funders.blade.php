@extends('layouts.app')

@section('template_title')
  List of funders
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .funders-table {
            border: 0;
        }
        .funders-table tr td:first-child {
            padding-left: 15px;
        }
        .funders-table tr td:last-child {
            padding-right: 15px;
        }
        .funders-table.table-responsive,
        .funders-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
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
                                                                       
                    </div>
                -->
                    <!-- END FILTERS -->
                    <!-- BEGIN RESULT -->
                    <div class="col-md-12">

                    <h4 class="page-header"><i class="fa fa-bank"></i> Funders</h4>

                     <div class="row">
                     {{ Form::open(array('route' => 'funders', 'method' => 'get')) }}
                    <!--
                    <div class="col-md-2">
                            <div class="input-group input-group-lg">
                                 <label></label>
                              <select name="country" id="country" class="form-control" width="100%">
                                  <option value="">Funder country </option>
                                  @foreach ($countries as $country)
                                  <option value="{{ $country->country }}" {{ (Request::get('country') == $country->country ? "selected":"") }}>{{ $country->country }} </option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                    -->
                        <div class="col-md-12">
                            <div class="input-group input-group-lg">
                            <input type="text" id="search-funders" value="{{ Request::get('q') }}" class="form-control" autocomplete="off" name="q" placeholder="Search funders..." data-toggle="tooltip" data-placement="bottom" title="You can search by any other keyword."/> <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Search <i class="fa fa-search"></i></button>
                            </span>
                            </div>
                        </div>
                    {{ Form::close() }}
                    </div>
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

                                    @foreach($funders as $funder)
                                        <tr>
                                            <td><strong><a href="{{ route('funders') }}/{{$funder->slug}}">{{$funder->name}}</a></strong><br>
                                            {{$funder->country}}</td>
                                            <td><a href="http://dx.doi.org/10.13039/{{$funder->funder_id}}" target="_blank">http://dx.doi.org/10.13039/{{$funder->funder_id}}</a></td>
                                           <!--
                                           @if(Auth::user() && Auth::user()->role->id == '1')
                                            <td>
                                                {!! Form::open(array('url' => 'funders/' . $funder->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete funder', 'data-message' => 'Are you sure you want to delete this funder ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @endif
                                        -->

                                            @if(Auth::user() && Auth::user()->role->id == '1')
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" target="_blank" href="{{ URL::to('admin/funders/' . $funder->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                             @endif

                                        </tr>
                                    @endforeach
                            
                            </tbody></table>
                        </div>
                        {{ $funders->links() }}
                        
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
