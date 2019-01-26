@extends('layouts.default')
@section('title')
    {{trans('auth::auth.user_list')}} | {{$project_name}}
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('organization::department.department_chart')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('organization::department.organization_management')</a></li>
            <li class="active">@lang('organization::department.department_chart')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@endsection