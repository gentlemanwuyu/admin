@extends('layouts.default')
@section('title')
    {{trans('template.department_chart')}} | {{$project_name}}
@endsection
@section('css')
    <style>
        #chart-container {
            text-align: center;
        }
        .orgchart { background: #fff; }
        .node-content {
            height: 28px;
            padding: 3px 10px;
            font-size: 16px;
            border: 1px solid rgba(217, 83, 79, 0.8);
            border-radius: 4px;
        }
        .orgchart .node {
            width: auto;
            min-width: 130px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.department_chart')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('template.organization_management')</a></li>
            <li class="active">@lang('template.department_chart')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <div id="chart-container"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function() {
            var load_index = layer.load();
            var draggable = false;
            @permission('drag_department')
                draggable = true;
            @endpermission
            // ajax请求结构图数据
            $.ajax({
                url: "{{route('organization::department.get_tree')}}",
                success: function (data) {
                    layer.close(load_index);
                    if ('success' == data.status) {
                        var oc = $('#chart-container').orgchart({
                            'data' : data.content,
                            'nodeID': 'id',
                            'draggable': draggable,
                            'createNode': function($node, data) {
                                var node_html = '';
                                node_html += '<div class="node-content" data-origin_value="' + data.name + '">';
                                node_html += data.name;
                                node_html += '</div>';
                                $node.html(node_html);
                            }
                        });

                        // 节点拖动
                        @permission('drag_department')
                            oc.$chart.on('nodedrop.orgchart', function(event, extraParams) {
                                var dragged_department_id = $(extraParams.draggedNode).attr('id');
                                var new_parent_id = $(extraParams.dropZone).attr('id');
                                var load_index = layer.load();
                                $.ajax({
                                    method: "post",
                                    url: "{{route('organization::department.drag')}}",
                                    data: {
                                        department_id: dragged_department_id,
                                        parent_id: new_parent_id
                                    },
                                    success: function (data) {
                                        layer.close(load_index);
                                        if ('success' == data.status) {
                                            layer.msg("{{trans('organization::department.drag_department_successful')}}", {icon:1});
                                            parent.location.reload();
                                        } else {
                                            layer.msg("{{trans('organization::department.drag_department_failed')}}:"+data.msg, {icon:2});
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
                        @endpermission

                        var items = {};
                        @permission('add_department')
                            items.add = {
                                name: "{{trans('application.add')}}",
                            callback: function(key, opt){
                                        var parent_id = $(this).attr('id');
                                        layer.prompt({
                                            value: '',
                                            maxlength: 64,
                                            title: "{{trans('organization::department.add_sub_department')}}"
                                        }, function (value, prompt_index, elem) {
                                            var load_index = layer.load();
                                            $.ajax({
                                                method: "post",
                                                url: "{{route('organization::department.add')}}",
                                                data: {
                                                    parent_id: parent_id,
                                                    department_name: value
                                                },
                                                success: function (data) {
                                                    layer.close(load_index);
                                                    if ('success' == data.status) {
                                                        layer.close(prompt_index);
                                                        layer.msg("{{trans('organization::department.add_sub_department_successful')}}", {icon:1});
                                                        parent.location.reload();
                                                    } else {
                                                        layer.msg("{{trans('organization::department.add_sub_department_failed')}}:"+data.msg, {icon:2});
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
                                    }
                            };
                        @endpermission

                        @permission('edit_department')
                            items.update = {
                                name: "{{trans('application.update')}}",
                            callback: function(key, opt){
                                    var department_id = $(this).attr('id');
                                    var origin_value = $(this).find('.node-content').html();
                                    layer.prompt({
                                        value: origin_value,
                                        maxlength: 64,
                                        title: "{{trans('organization::department.update_department_name')}}"
                                    }, function (value, prompt_index, elem) {
                                        var load_index = layer.load();
                                        $.ajax({
                                            method: "post",
                                            url: "{{route('organization::department.update')}}",
                                            data: {
                                                department_id: department_id,
                                                department_name: value
                                            },
                                            success: function (data) {
                                                layer.close(load_index);
                                                if ('success' == data.status) {
                                                    layer.close(prompt_index);
                                                    layer.msg("{{trans('organization::department.update_department_successful')}}", {icon:1});
                                                    parent.location.reload();
                                                } else {
                                                    layer.msg("{{trans('organization::department.update_department_failed')}}:"+data.msg, {icon:2});
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
                                }
                            };
                        @endpermission
                        @permission('delete_department')
                            items.delete = {
                                name: "{{trans('application.delete')}}",
                                callback: function(key, opt){
                                    var department_id = $(this).attr('id');
                                    layer.confirm("{{trans('organization::department.delete_department_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (confirm_index) {
                                        layer.close(confirm_index);
                                        var load_index = layer.load();
                                        $.ajax({
                                            method: "post",
                                            url: "{{route('organization::department.delete')}}",
                                            data: {
                                                department_id: department_id
                                            },
                                            success: function (data) {
                                                layer.close(load_index);
                                                if ('success' == data.status) {
                                                    layer.msg("{{trans('organization::department.delete_department_successful')}}", {icon:1});
                                                    parent.location.reload();
                                                } else {
                                                    layer.msg("{{trans('organization::department.delete_department_failed')}}:"+data.msg, {icon:2});
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
                                }
                            };
                        @endpermission

                        // 节点右键菜单
                        $.contextMenu({
                            selector: '.node',
                            items: items
                        });
                    } else {
                        layer.msg("{{trans('organization::department.get_department_failed')}}:"+data.msg, {icon:2});
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.close(load_index);
                    layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                }
            });
        });
    </script>
@endsection