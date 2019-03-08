@extends('layouts.default')
@section('title')
    {{trans('template.'.$type.'_category')}} | {{$project_name}}
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.'.$type.'_category')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tree"></i>@lang('template.category_management')</a></li>
            <li class="active">@lang('template.'.$type.'_category')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_category" type="button" class="btn btn-primary" title="{{trans('category::category.add_category')}}"><i class="fa fa-tree"></i></button>
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
                <div id="category_tree">
                    <ul>
                        @foreach($categories as $category)
                            <li id="{{$category->id}}" data-jstree='{"opened": true}' data-level="1">
                                {{$category->name}}
                                @if(isset($category->children) && $category->children)
                                    <ul>
                                        @foreach($category->children as $son)
                                            <li id="{{$son->id}}" data-jstree='{"opened": true}' data-level="2">
                                                {{$son->name}}
                                                @if(isset($son->children) && $son->children)
                                                    <ul>
                                                        @foreach($son->children as $grandson)
                                                            <li id="{{$grandson->id}}" data-level="3">
                                                                {{$grandson->name}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            var type = "{{$type}}";

            $('#category_tree').jstree({
                "plugins": ["contextmenu", "search", "types", "unique"],
                "types": {
                    "default": {
                        "icon": false
                    }
                },
                "contextmenu": {
                    "items": function (node) {
                        var category_id = node.id;
                        var items = {
                            "add": {
                                "label": "{{trans('category::category.add_sub_category')}}",
                                "icon": "fa fa-plus-square-o",
                                "action": function () {
                                    layer.open({
                                        type: 2,
                                        area: ['50%', '60%'],
                                        fix: false,
                                        skin: 'layui-layer-rim',
                                        maxmin: true,
                                        shade: 0.5,
                                        anim: 4,
                                        title: "{{trans('category::category.add_category')}}",
                                        btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                                        yes: function (index) {
                                            var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                                            var load_index = layer.load();
                                            $.ajax({
                                                method: "post",
                                                url: "{{route('category::category.create_or_update_category')}}",
                                                data: data,
                                                success: function (data) {
                                                    layer.close(load_index);
                                                    if ('success' == data.status) {
                                                        layer.close(index);
                                                        layer.msg("{{trans('category::category.category_create_or_update_successful')}}", {icon:1});
                                                        parent.location.reload();
                                                    } else {
                                                        layer.msg("{{trans('category::category.category_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                                        content: "{{route('category::category.create_or_update_category_page')}}?action=create&type=" + type + "&parent_id=" + category_id
                                    });
                                }
                            },
                            "edit": {
                                "label": "{{trans('application.update')}}",
                                "icon": "fa fa-edit",
                                "action": function () {
                                    layer.open({
                                        type: 2,
                                        area: ['50%', '60%'],
                                        fix: false,
                                        skin: 'layui-layer-rim',
                                        maxmin: true,
                                        shade: 0.5,
                                        anim: 4,
                                        title: "{{trans('category::category.edit_category')}}",
                                        btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                                        yes: function (index) {
                                            var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                                            var load_index = layer.load();
                                            $.ajax({
                                                method: "post",
                                                url: "{{route('category::category.create_or_update_category')}}",
                                                data: data,
                                                success: function (data) {
                                                    layer.close(load_index);
                                                    if ('success' == data.status) {
                                                        layer.close(index);
                                                        layer.msg("{{trans('category::category.category_create_or_update_successful')}}", {icon:1});
                                                        parent.location.reload();
                                                    } else {
                                                        layer.msg("{{trans('category::category.category_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                                        content: "{{route('category::category.create_or_update_category_page')}}?action=update&type=" + type + "&category_id=" + category_id
                                    });
                                }
                            },
                            "delete": {
                                "label": "{{trans('application.delete')}}",
                                "icon": "fa fa-trash",
                                "action": function () {
                                    layer.confirm("{{trans('category::category.category_delete_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                                        layer.close(index);
                                        var load_index = layer.load();
                                        $.ajax({
                                            method: "post",
                                            url: "{{route('category::category.delete_category')}}",
                                            data: {category_id: category_id, type: type},
                                            success: function (data) {
                                                layer.close(load_index);
                                                if ('success' == data.status) {
                                                    layer.msg("{{trans('category::category.category_delete_successful')}}", {icon:1});
                                                    parent.location.reload();
                                                } else {
                                                    layer.msg("{{trans('category::category.category_delete_fail')}}"+data.msg, {icon:2});
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
                            }
                        };

                        // 最多3级分类，3级分类的右键菜单不显示添加子分类
                        if (3 == node.data.level) {
                            delete items.add;
                        }

                        return items;
                    }
                }
            });
            
            $('form').on('submit', function (e) {
                e.preventDefault();
                $('#category_tree').jstree(true).search($('input[name=search]').val());
            });
            
            $('#add_category').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('category::category.add_category')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('category::category.create_or_update_category')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('category::category.category_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('category::category.category_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('category::category.create_or_update_category_page')}}?action=create&type=" + type
                });
            });
        });
    </script>
@endsection
