@extends('layouts.app')

@section('template_title')
  Showing funder {{ $funder->name }}
@endsection


@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="panel panel-success">

          <div class="panel-heading">
            <a href="/funders/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to funders</span>
            </a>
            {{ $funder->name }}
          </div>
          <div class="panel-body">

            <div class="well">
              <div class="row">
                <div class="col-sm-6">
                  <img src="@if ($funder->logo) {{ $funder->logo }} @else {{ '' }} @endif" alt="{{ $funder->name }}" id="" class="img-circle center-block margin-bottom-2 margin-top-1 funder-image">
                </div>

                <div class="col-sm-6">
                  <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                    {{ $funder->name }}
                  </h4>
                  <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                    {{ $funder->country }}
                  </h4>
                  <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                    {{ $funder->funder_id }}
                  </h4>
                  
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            
      

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($funder->created_at)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelCreatedAt') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $funder->created_at }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($funder->updated_at)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelUpdatedAt') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $funder->updated_at }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

          

          </div>

        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')

@endsection
