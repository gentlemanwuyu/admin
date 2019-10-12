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
                <table class="table table-bordered table-hover">
                    <thead>
                    <th>@lang('application.index_number')</th>
                    <th>@lang('application.name')</th>
                    <th>@lang('supplier::supplier.supplier_code')</th>
                    <th>@lang('application.phone')</th>
                    <th>@lang('application.contact')</th>
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
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->code or ''}}</td>
                            <td>{{$supplier->phone or ''}}</td>
                            <td></td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_supplier" title="{{trans('supplier::supplier.edit_supplier')}}"></i>
                                </a>
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
        });
    </script>
@endsection