@extends('layouts.default')
@section('title')
    {{trans('template.position_management')}} | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.position_management')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('template.organization_management')</a></li>
            <li class="active">@lang('template.position_management')</li>
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