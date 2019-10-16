@extends('layouts.default')
@section('title')
    {{trans('template.my_customer')}} | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.my_customer')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-male"></i>@lang('template.customer_management')</a></li>
            <li class="active">@lang('template.my_customer')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_customer" type="button" class="btn btn-primary" title="{{trans('customer::customer.add_customer')}}"><i class="fa fa-male"></i></button>
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
                    <th>@lang('application.name')</th>
                    <th>@lang('customer::customer.customer_code')</th>
                    <th>@lang('application.phone')</th>
                    <th>@lang('application.contact')</th>
                    <th>@lang('application.manager')</th>
                    <th>@lang('application.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $customers->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($customers as $customer)
                        <tr data-id="{{$customer->id}}">
                            <td>{{$i++}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->code or ''}}</td>
                            <td>{{$customer->phone_number or ''}}</td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_customer" title="{{trans('customer::customer.edit_customer')}}"></i>
                                </a>
                                <a href="javascript:;">
                                    <i class="fa fa-trash delete_customer" title="{{trans('customer::customer.delete_customer')}}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{$customers->links()}}
            </div>
        </div>
    </section>
@endsection