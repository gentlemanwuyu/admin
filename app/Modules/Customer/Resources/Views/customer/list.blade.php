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
                    <th width="5%">@lang('application.index_number')</th>
                    <th width="15%">@lang('application.name')</th>
                    <th width="15%">@lang('customer::customer.customer_code')</th>
                    <th width="15%">@lang('application.phone')</th>
                    <th class="multi-th">
                        <div style="">@lang('application.contact')</div>
                        <ul class="list-inline">
                            <li class="col-xs-4">@lang('application.name')</li>
                            <li class="col-xs-4">@lang('application.position')</li>
                            <li class="col-xs-4">@lang('application.phone')</li>
                        </ul>
                    </th>
                    <th width="10%">@lang('application.manager')</th>
                    <th width="15%">@lang('application.action')</th>
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
                            <td class="multi-td">
                                @foreach($customer->contacts as $contact)
                                    <ul class="list-inline">
                                        <li class="col-xs-4">{{$contact->name or ''}}</li>
                                        <li class="col-xs-4">{{$contact->position or ''}}</li>
                                        <li class="col-xs-4">{{$contact->phone_number or ''}}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>{{$customer->manager->name or ''}}</td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_customer" title="{{trans('customer::customer.edit_customer')}}"></i>
                                </a>
                                <a href="javascript:;">
                                    <i class="fa fa-fire black_customer" title="{{trans('customer::customer.black_customer')}}"></i>
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
@section('scripts')
    <script>
        $(function () {
            // 添加客户
            $('#add_customer').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('customer::customer.add_customer')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('customer::customer.create_or_update_customer')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('customer::customer.customer_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('customer::customer.customer_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('customer::customer.create_or_update_customer_page')}}?action=create&manager_id={{$user->id}}"
                });
            });

            // 编辑客户
            $('.edit_customer').on('click', function () {
                var customer_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('customer::customer.edit_customer')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('customer::customer.create_or_update_customer')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('customer::customer.customer_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('customer::customer.customer_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('customer::customer.create_or_update_customer_page')}}?action=update&customer_id=" + customer_id
                });
            });

            // 拉黑客户
            $('.black_customer').on('click', function () {
                var customer_id = $(this).parents('tr').attr('data-id');
                layer.prompt({
                    title: "{{trans('customer::customer.black_customer')}}"
                }, function (value, prompt_index, elem) {
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('customer::customer.black_customer')}}",
                        data: {
                            customer_id: customer_id,
                            reason: value
                        },
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.close(prompt_index);
                                layer.msg("{{trans('customer::customer.customer_black_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('customer::customer.customer_black_fail')}}"+data.msg, {icon:2});
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

            // 删除客户
            $('.delete_customer').on('click', function () {
                var customer_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('customer::customer.customer_delete_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('customer::customer.delete_customer')}}",
                        data: {customer_id: customer_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('customer::customer.customer_delete_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('customer::customer.customer_delete_fail')}}"+data.msg, {icon:2});
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