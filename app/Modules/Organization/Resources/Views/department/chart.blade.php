@extends('layouts.default')
@section('title')
    {{trans('organization::department.department_chart')}} | {{$project_name}}
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
            position: relative;
        }
        .node i {
            position: absolute;
            right: 0;
            top: 0;
            color: rgba(217, 83, 79, 0.8);
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('organization::department.department_chart')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('organization::department.organization_management')</a></li>
            <li class="active">@lang('organization::department.department_chart')</li>
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
            // ajax请求结构图数据
            $.ajax({
                url: "{{route('organization::department.get_tree')}}",
                success: function (data) {
                    layer.close(load_index);
                    if ('success' == data.status) {
                        $('#chart-container').orgchart({
                            'data' : data.content,
                            'nodeID': 'id',
                            'draggable': true,
                            'createNode': function($node, data) {
                                var node_html = '';
                                node_html += '<div class="node-content" contenteditable="false" data-origin_value="' + data.name + '">';
                                node_html += data.name;
                                node_html += '</div>';
                                // 根节点不能显示删除按钮
                                if (1 != data.id) {
                                    node_html += '<i class="fa fa-close" style="display: none"></i>';
                                }
                                $node.html(node_html);
                            }
                        });

                        $('.node-content').on('blur', function () {
                            var department_name = $(this).html();
                            if (0 == department_name.length) {
                                layer.msg("{{trans('organization::department.department_name_cannot_empty')}}");
                                $(this).html($(this).attr('data-origin_value'));
                                return false;
                            }
                            var department_id = $(this).parents('.node').attr('id');
                            var load_index = layer.load();
                            $.ajax({
                                method: "post",
                                url: "{{route('organization::department.update')}}",
                                data: {
                                    department_id: department_id,
                                    department_name: department_name
                                },
                                success: function (data) {
                                    layer.close(load_index);
                                    if ('success' == data.status) {
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

                        // 加载完结构图后，绑定鼠标事件
                        $('.node').on('mouseover', function () {
                            $(this).find('i').show();
                        });
                        $('.node').on('mouseout', function () {
                            $(this).find('i').hide();
                        });
                        $('.node i').on('click', function () {
                            var department_id = $(this).parents('.node').attr('id');
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