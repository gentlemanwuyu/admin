@extends('layouts.default')
@section('title')
    {{trans('template.customer_payment_method_application_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.customer_payment_method_application_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-male"></i>@lang('template.customer_management')</a></li>
            <li class="active">@lang('template.customer_payment_method_application_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <th width="5%">@lang('application.index_number')</th>
                    <th width="15%">@lang('application.name')</th>
                    <th width="15%">@lang('customer::customer.customer_code')</th>
                    <th width="10%">@lang('customer::customer.payment_method')</th>
                    <th width="5%">@lang('customer::customer.limit_amount')</th>
                    <th width="5%">@lang('customer::customer.monthly_day')</th>
                    <th>@lang('customer::customer.apply_reason')</th>
                    <th width="8%">@lang('application.status')</th>
                    <th width="10%">@lang('application.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $applications->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($applications as $application)
                        <tr data-id="{{$application->id}}">
                            <td>{{$i++}}</td>
                            <td>{{$application->customer->name}}</td>
                            <td>{{$application->customer->code or ''}}</td>
                            <td>{{$application->payment_method_name ? trans('application.' . $application->payment_method_name) : ''}}</td>
                            <td>
                                @if(2 == $application->method_id)
                                    {{$application->limit_amount}}
                                @endif
                            </td>
                            <td>
                                @if(3 == $application->method_id)
                                    {{$application->monthly_day}}
                                @endif
                            </td>
                            <td>{{$application->message or ''}}</td>
                            <td>{{$application->status_name ? trans('customer::customer.' . $application->status_name) : ''}}</td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_customer" title="{{trans('customer::customer.edit_customer')}}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{$applications->links()}}
            </div>
        </div>
    </section>
@endsection