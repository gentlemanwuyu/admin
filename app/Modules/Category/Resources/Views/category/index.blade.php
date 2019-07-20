@extends('layouts.default')
@section('title')
    {{trans('template.category_tree')}} | {{$project_name}}
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.category_tree')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tree"></i>@lang('template.category_management')</a></li>
            <li class="active">@lang('template.category_tree')</li>
        </ol>
    </section>
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li data-tab_name="tab_product_category">
                    <a href="#product_category_tree" data-toggle="tab" aria-expanded="true" data-cookie_name="category_tree_tab" data-cookie_value="0">@lang('category::category.product_category')</a>
                </li>
                <li data-tab_name="tab_goods_category">
                    <a href="#goods_category_tree" data-toggle="tab" aria-expanded="true" data-cookie_name="category_tree_tab" data-cookie_value="1">@lang('category::category.goods_category')</a>
                </li>
                <div class="col-xs-1" style="padding-top: 5px;">
                    <div class="btn-group">
                        <button id="add_category" type="button" class="btn btn-primary" title="{{trans('category::category.add_category')}}"><i class="fa fa-tree"></i></button>
                    </div>
                </div>
                <div class="col-xs-2 pull-right" style="padding-top: 7px;">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="{{trans('application.search')}}">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </ul>
            <div class="tab-content banner" style="padding: 0;">
                <div class="tab-pane" id="product_category_tree">
                    <div class="box box-primary">
                        <div class="box-body table-responsive">
                            <div class="category_tree">
                                <ul>
                                    @foreach($product_categories as $product_category)
                                        <li id="{{$product_category->id}}" data-jstree='{"opened": true}' data-level="1">
                                            {{$product_category->name}}
                                            @if(!$product_category->children->isEmpty())
                                                <ul>
                                                    @foreach($product_category->children as $product_son)
                                                        <li id="{{$product_son->id}}" data-jstree='{"opened": true}' data-level="2">
                                                            {{$product_son->name}}
                                                            @if(!$product_son->children->isEmpty())
                                                                <ul>
                                                                    @foreach($product_son->children as $product_grandson)
                                                                        <li id="{{$product_grandson->id}}" data-level="3">
                                                                            {{$product_grandson->name}}
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
                    </div>
                </div>
                <div class="tab-pane" id="goods_category_tree">
                    <div class="box box-primary">
                        <div class="box-body table-responsive">
                            <div class="category_tree">
                                <ul>
                                    @foreach($goods_categories as $goods_category)
                                        <li id="{{$goods_category->id}}" data-jstree='{"opened": true}' data-level="1">
                                            {{$goods_category->name}}
                                            @if(!$goods_category->children->isEmpty())
                                                <ul>
                                                    @foreach($goods_category->children as $goods_son)
                                                        <li id="{{$goods_son->id}}" data-jstree='{"opened": true}' data-level="2">
                                                            {{$goods_son->name}}
                                                            @if(!$goods_son->children->isEmpty())
                                                                <ul>
                                                                    @foreach($goods_son->children as $goods_grandson)
                                                                        <li id="{{$goods_grandson->id}}" data-level="3">
                                                                            {{$goods_grandson->name}}
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        var tab_types = [
            @foreach(\App\Modules\Category\Models\Category::$types as $type)
                "{{$type}}",
            @endforeach
        ];
        $(function () {
            // active标签
            var active_tab = getCookie('category_tree_tab') ? getCookie('category_tree_tab') : 0;
            $('.nav-tabs-custom ul a:eq(' + active_tab + ')').tab('show');

            // 分类树初始化
            $('.category_tree').jstree({
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
                                        content: "{{route('category::category.create_or_update_category_page')}}?action=create&parent_id=" + category_id
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
                                        content: "{{route('category::category.create_or_update_category_page')}}?action=update&category_id=" + category_id
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
                                            data: {category_id: category_id},
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

            // 搜索
            $('input[name=search]').on('keyup', function (e) {
                e.preventDefault();
                $('#' + tab_types[active_tab] + '_category_tree .category_tree').jstree(true).search(this.value);
            });

            // tab标签切换监控
            $("a[data-toggle='tab']").on('shown.bs.tab', function (e) {
                var target = $(this).attr('href');
                $(target).find('.category_tree').jstree(true).search($('input[name=search]').val());
                active_tab = getCookie('category_tree_tab');
            });

            // 添加分类
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
                    content: "{{route('category::category.create_or_update_category_page')}}?action=create&type=" + (parseInt(active_tab) + 1)
                });
            });
        });
    </script>
@endsection