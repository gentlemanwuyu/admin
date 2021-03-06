@extends('layouts.default')
@section('title')
    {{trans('template.customer_payment_method_application_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>
        #review_application_layer .layui-layer-btn .layui-layer-btn1 {
            border-color: #dd4b39;
            background-color: #dd4b39;
            color: #fff;
        }
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
                <form class="search-form">
                    <div class="row">
                        <div class="col-xs-2">
                            <input type="text" name="name" class="form-control" value="{{$name or ''}}" placeholder="@lang('application.name')">
                        </div>
                        <div class="col-xs-2">
                            <?php
                                $methods = Payment::$methods;
                                unset($methods[1]);
                            ?>
                            <select class="form-control" name="payment_method_id">
                                <option value="">@lang('customer::customer.payment_method')</option>
                                @foreach($methods as $method_id => $method_name)
                                    <option value="{{$method_id}}" @if(isset($payment_method_id) && $payment_method_id == $method_id) selected @endif>{{trans('application.' . $method_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" name="status">
                                <option value="">@lang('application.status')</option>
                                @foreach(\App\Modules\Customer\Models\CustomerPaymentMethodApplication::$statuses as $status_id => $status_name)
                                    <option value="{{$status_id}}" @if(isset($status) && $status == $status_id) selected @endif>{{trans('customer::customer.' . $status_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-1">
                            <button type="submit" class="btn btn-primary" style="width:100%">@lang("application.search")</button>
                        </div>
                    </div>
                </form>
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
                                @if(in_array($application->status, [1, 3]))
                                    <a href="javascript:;">
                                        <i class="fa fa-edit edit_application" title="{{trans('customer::customer.edit_application')}}"></i>
                                    </a>
                                @endif
                                @if(1 == $application->status)
                                    <a href="javascript:;">
                                        <i class="fa fa-check-square-o review_application" title="{{trans('customer::customer.review_application')}}"></i>
                                    </a>
                                @endif
                                @if(in_array($application->status, [1, 2, 3]))
                                    <a href="javascript:;">
                                        <i class="fa fa-close close_application" title="{{trans('customer::customer.close_application')}}"></i>
                                    </a>
                                @endif
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
@section('scripts')
    <script>
        $(function () {
            // 编辑申请单
            $('.edit_application').on('click', function () {
                var application_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('customer::customer.edit_application')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('customer::customer.update_payment_method_application')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('customer::customer.payment_method_application_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('customer::customer.payment_method_application_update_fail')}}:"+data.msg, {icon:2});
                                    return false;
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                layer.close(load_index);
                                layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                return false;
                            }
                        });
                    },
                    content: "{{route('customer::customer.create_or_update_payment_method_application_page')}}?action=update&application_id=" + application_id
                });
            });

            // 审核申请单
            $('.review_application').on('click', function () {
                var application_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    id: 'review_application_layer',
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('customer::customer.review_application')}}",
                    btn: ['{{trans('application.agree')}}', '{{trans('application.reject')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('customer::customer.review_payment_method_application')}}",
                            data: {application_id: application_id, status: 2},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('customer::customer.payment_method_application_agreed')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('application.action_fail')}}:"+data.msg, {icon:2});
                                    return false;
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                layer.close(load_index);
                                layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                return false;
                            }
                        });
                    },
                    btn2: function (index) {
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('customer::customer.review_payment_method_application')}}",
                            data: {application_id: application_id, status: 3},
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('customer::customer.payment_method_application_rejected')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('application.action_fail')}}:"+data.msg, {icon:2});
                                    return false;
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                layer.close(load_index);
                                layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                return false;
                            }
                        });
                    },
                    content: "{{route('customer::customer.create_or_update_payment_method_application_page')}}?action=view&application_id=" + application_id
                });
            });

            // 关闭申请单
            $('.close_application').on('click', function () {
                var application_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('customer::customer.close_application_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('customer::customer.close_payment_method_application')}}",
                        data: {application_id: application_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('customer::customer.close_application_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('customer::customer.close_application_fail')}}"+data.msg, {icon:2});
                                return false;
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            layer.close(load_index);
                            layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                            return false;
                        }
                    });
                });
            });
        });
    </script>
@endsection