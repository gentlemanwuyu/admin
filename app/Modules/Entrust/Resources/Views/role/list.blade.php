@extends('layouts.default')
@section('title')
    {{trans('template.role_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.role_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('template.auth_management')</a></li>
            <li class="active">@lang('template.role_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_role" type="button" class="btn btn-primary" title="{{trans('entrust::permission.add_role')}}"><i class="fa fa-object-group"></i></button>
                    </div>
                </div>
                <div class="col-xs-2 pull-right">
                    <form>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control pull-right" value="{{$search or ''}}" placeholder="{{trans('application.search')}}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <th>@lang('application.index_number')</th>
                    <th>@lang('entrust::role.name')</th>
                    <th>@lang('entrust::role.display_name')</th>
                    <th>@lang('application.description')</th>
                    <th>@lang('application.created_at')</th>
                    <th>@lang('application.updated_at')</th>
                    <th>@lang('application.action')</th>
                    </thead>

                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@endsection