@extends('layouts.default')
@section('title')
    {{trans('template.supplier_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>
        td>ul.list-group>li {
            border-left: 0;
            border-right: 0;
        }
        td>ul.list-group>li:first-child {
             border-top: 0;
         }
        td>ul.list-group>li:last-child {
            border-bottom: 0;
        }
    </style>
@endsection
@section('content')
    @inject('supplierPresenter', 'App\Modules\Supplier\Presenters\SupplierPresenter')
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
                <form class="search-form">
                    <div class="row">
                        <div class="col-xs-2">
                            <input type="text" name="name" class="form-control" value="{{$name or ''}}" placeholder="@lang('application.name')">
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" name="is_black">
                                <option value="">@lang('supplier::supplier.is_black')</option>
                                <option value="1" @if(isset($is_black) && 1 == $is_black) selected @endif>{{trans('application.no')}}</option>
                                <option value="2" @if(isset($is_black) && 2 == $is_black) selected @endif>{{trans('application.yes')}}</option>
                            </select>
                        </div>
                        <div class="col-xs-1">
                            <button type="submit" class="btn btn-primary" style="width:100%">@lang("application.search")</button>
                        </div>
                        <div class="col-xs-1">
                            <button id="add_supplier" type="button" class="btn btn-primary" title="{{trans('supplier::supplier.add_supplier')}}"><i class="fa fa-street-view"></i></button>
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
                    <th width="15%">@lang('supplier::supplier.supplier_code')</th>
                    <th width="15%">@lang('application.phone')</th>
                    <th width="8%">@lang('supplier::supplier.is_black')</th>
                    <th class="multi-th">
                        <div style="">@lang('application.contact')</div>
                        <ul class="list-inline">
                            <li class="col-xs-4">@lang('application.name')</li>
                            <li class="col-xs-4">@lang('application.position')</li>
                            <li class="col-xs-4">@lang('application.phone')</li>
                        </ul>
                    </th>
                    <th>@lang('application.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $suppliers->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($suppliers as $supplier)
                        <tr data-id="{{$supplier->id}}">
                            <td>{{$i++}}</td>
                            <td>
                                <a href="{{route('supplier::supplier.detail', ['id' => $supplier->id])}}" target="_blank">{{$supplier->name}}</a>
                            </td>
                            <td>{{$supplier->code or ''}}</td>
                            <td>{{$supplier->phone_number or ''}}</td>
                            <td>{{2 == $supplier->is_black ? trans('application.yes') : trans('application.no')}}</td>
                            <td class="multi-td">
                                @foreach($supplier->contacts as $contact)
                                    <ul class="list-inline">
                                        <li class="col-xs-4">{{$contact->name or ''}}</li>
                                        <li class="col-xs-4">{{$contact->position or ''}}</li>
                                        <li class="col-xs-4">{{$contact->phone_number or ''}}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_supplier" title="{{trans('supplier::supplier.edit_supplier')}}"></i>
                                </a>
                                @if(1 == $supplier->is_black)
                                    <a href="javascript:;">
                                        <i class="fa fa-fire black_supplier" title="{{trans('supplier::supplier.black_supplier')}}"></i>
                                    </a>
                                @endif
                                @if(2 == $supplier->is_black)
                                    <a href="javascript:;">
                                        <i class="fa fa-fire-extinguisher release_supplier" title="{{trans('supplier::supplier.release_supplier')}}"></i>
                                    </a>
                                @endif
                                <a href="javascript:;">
                                    <i class="fa fa-trash delete_supplier" title="{{trans('supplier::supplier.delete_supplier')}}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{$suppliers->links()}}
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            // 添加供应商
            $('#add_supplier').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('supplier::supplier.add_supplier')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('supplier::supplier.create_or_update_supplier')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('supplier::supplier.supplier_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('supplier::supplier.supplier_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('supplier::supplier.create_or_update_supplier_page')}}?action=create"
                });
            });

            // 编辑供应商
            $('.edit_supplier').on('click', function () {
                var supplier_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('supplier::supplier.edit_supplier')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('supplier::supplier.create_or_update_supplier')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('supplier::supplier.supplier_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('supplier::supplier.supplier_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('supplier::supplier.create_or_update_supplier_page')}}?action=update&supplier_id=" + supplier_id
                });
            });

            // 拉黑供应商
            $('.black_supplier').on('click', function () {
                var supplier_id = $(this).parents('tr').attr('data-id');
                layer.prompt({
                    title: "{{trans('supplier::supplier.black_supplier')}}"
                }, function (value, prompt_index, elem) {
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('supplier::supplier.black_supplier')}}",
                        data: {
                            supplier_id: supplier_id,
                            reason: value
                        },
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.close(prompt_index);
                                layer.msg("{{trans('supplier::supplier.supplier_black_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('supplier::supplier.supplier_black_fail')}}"+data.msg, {icon:2});
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

            // 释放供应商
            $('.release_supplier').on('click', function () {
                var supplier_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('supplier::supplier.supplier_release_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('supplier::supplier.release_supplier')}}",
                        data: {supplier_id: supplier_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('supplier::supplier.supplier_release_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('supplier::supplier.supplier_release_fail')}}"+data.msg, {icon:2});
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

            // 删除供应商
            $('.delete_supplier').on('click', function () {
                var supplier_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('supplier::supplier.supplier_delete_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('supplier::supplier.delete_supplier')}}",
                        data: {supplier_id: supplier_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('supplier::supplier.supplier_delete_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('supplier::supplier.supplier_delete_fail')}}"+data.msg, {icon:2});
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