@extends('layouts.default')
@section('title')
    {{trans('template.supplier_list')}} | {{$project_name}}
@endsection
@section('css')

@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.supplier_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-street-view"></i>@lang('template.supplier_management')</a></li>
            <li class="active">@lang('template.supplier_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_supplier" type="button" class="btn btn-primary" title="{{trans('supplier::supplier.add_supplier')}}"><i class="fa fa-street-view"></i></button>
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

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@endsection