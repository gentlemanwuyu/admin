@extends('layouts.default')
@section('title')
    {{trans('template.permission_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.permission_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('template.auth_management')</a></li>
            <li class="active">@lang('template.permission_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    @permission('add_permission')
                        <div class="btn-group">
                            <button id="add_permission" type="button" class="btn btn-primary" title="{{trans('entrust::permission.add_permission')}}"><i class="fa fa-street-view"></i></button>
                        </div>
                    @endpermission
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
                    <th>@lang('entrust::permission.name')</th>
                    <th>@lang('entrust::permission.display_name')</th>
                    <th>@lang('application.description')</th>
                    <th>@lang('application.type')</th>
                    <th>@lang('application.created_at')</th>
                    <th>@lang('application.updated_at')</th>
                    <th>@lang('application.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $permissions->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($permissions as $permission)
                        <tr data-id="{{$permission->id}}">
                            <td>{{$i++}}</td>
                            <td>{{$permission->name or ''}}</td>
                            <td>{{$permission->display_name or ''}}</td>
                            <td>{{$permission->description or ''}}</td>
                            <td>{{trans('application.'.$permission->type)}}</td>
                            <td>{{$permission->created_at}}</td>
                            <td>{{$permission->updated_at}}</td>
                            <td>
                                @permission('edit_permission')
                                    <a href="javascript:;">
                                        <i class="fa fa-edit edit_permission" title="{{trans('entrust::permission.edit_permission')}}"></i>
                                    </a>
                                @endpermission
                                @permission('delete_permission')
                                    <a href="javascript:;">
                                        <i class="fa fa-trash delete_permission" title="{{trans('entrust::permission.delete_permission')}}"></i>
                                    </a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{$permissions->links()}}
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            // 添加权限
            $('#add_permission').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('entrust::permission.add_permission')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('entrust::permission.create_or_update')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('entrust::permission.create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('entrust::permission.create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('entrust::permission.create_or_update_page')}}?action=create"
                });
            });

            // 修改权限
            $('.edit_permission').on('click', function () {
                var permission_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('entrust::permission.edit_permission')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('entrust::permission.create_or_update')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('entrust::permission.create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('entrust::permission.create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('entrust::permission.create_or_update_page')}}?action=update&permission_id=" + permission_id
                });
            });

            // 删除权限
            $('.delete_permission').on('click', function () {
                var permission_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('entrust::permission.permission_delete_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('entrust::permission.delete')}}",
                        data: {permission_id: permission_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('entrust::permission.permission_delete_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('entrust::permission.permission_delete_fail')}}"+data.msg, {icon:2});
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