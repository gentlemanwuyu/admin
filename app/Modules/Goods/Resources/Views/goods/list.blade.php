@extends('layouts.default')
@section('title')
    {{trans('template.goods_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.goods_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cubes"></i>@lang('template.goods_management')</a></li>
            <li class="active">@lang('template.goods_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_goods" type="button" class="btn btn-primary" title="{{trans('goods::goods.add_goods')}}"><i class="fa fa-cube"></i></button>


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
                    <th>@lang('application.image')</th>
                    <th>@lang('goods::goods.goods_code')</th>
                    <th>@lang('goods::goods.goods_name')</th>
                    <th>@lang('goods::goods.type')</th>
                    <th>@lang('goods::goods.category')</th>
                    <th class="th_list">
                        <div class="row th_content_div">
                            @lang('goods::goods.sku_list')
                        </div>
                        <div class="row">
                            <div class="col-xs-6 th_content_div">sku编码</div>
                            <div class="col-xs-3 th_content_div">最低售价</div>
                            <div class="col-xs-3 th_content_div">建议零售价</div>
                        </div>
                    </th>
                    <th>@lang('application.action')</th>
                    </thead>
                    <tbody>
                    @foreach($goods as $g)
                        <tr data-id="{{$g->id}}" data-type="{{$g->type}}">
                            <td>{{$g->id}}</td>
                            <td><img src="{{$g->image_link or ''}}" style="max-width: 100px;height: auto;"></td>
                            <td>{{$g->code}}</td>
                            <td>{{$g->name}}</td>
                            <td>{{trans('goods::goods.'.$g->type_name)}}</td>
                            <td>{{$g->category->display_name}}</td>
                            <td class="td_list">
                                <table class="table table-bordered table-hover">
                                    @foreach($g->skus as $goods_sku)
                                        <tr>
                                            <td class="col-xs-6">{{$goods_sku->code}}</td>
                                            <td class="col-xs-3">{{$goods_sku->lowest_price}}</td>
                                            <td class="col-xs-3">{{$goods_sku->msrp}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_goods" title="{{trans('goods::goods.edit_goods')}}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function addSinglePage(){
            layer.open({
                type: 2,
                area: ['80%', '80%'],
                fix: false,
                skin: 'layui-layer-rim',
                maxmin: true,
                shade: 0.5,
                anim: 4,
                title: "{{trans('goods::goods.choose_product')}}",
                btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                yes: function (index) {
                    var data = $(layer.getChildFrame('body',index)).find('.box-body>form').serializeArray();
                    if (0 == data.length) {
                        layer.msg("{{trans('goods::goods.please_choose_product')}}", {icon:2});
                        return false;
                    }
                    layer.close(index);
                    layer.open({
                        type: 2,
                        area: ['80%', '80%'],
                        fix: false,
                        skin: 'layui-layer-rim',
                        maxmin: true,
                        shade: 0.5,
                        anim: 4,
                        title: "{{trans('goods::goods.add_single')}}",
                        btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                        yes: function (index) {
                            var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                            var load_index = layer.load();
                            $.ajax({
                                method: "post",
                                url: "{{route('goods::goods.create_or_update_single')}}",
                                data: data,
                                success: function (data) {
                                    layer.close(load_index);
                                    if ('success' == data.status) {
                                        layer.close(index);
                                        layer.msg("{{trans('goods::goods.goods_create_or_update_successful')}}", {icon:1});
                                        parent.location.reload();
                                    } else {
                                        layer.msg("{{trans('goods::goods.goods_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                        content: "{{route('goods::goods.create_or_update_single_page')}}?action=create&product_id=" + data[0].value
                    });
                },
                content: "{{route('goods::goods.choose_single_product_page')}}"
            });
        }

        function addComboPage(){
            layer.open({
                type: 2,
                area: ['80%', '80%'],
                fix: false,
                skin: 'layui-layer-rim',
                maxmin: true,
                shade: 0.5,
                anim: 4,
                title: "{{trans('goods::goods.choose_product')}}",
                btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                yes: function (index) {
                    var dataForm =  $(layer.getChildFrame('body',index)).find('form');
                    var data = dataForm.serializeArray();
                    if (0 == data.length) {
                        layer.msg("{{trans('goods::goods.please_choose_product')}}", {icon:2});
                        return false;
                    }
                    if (2 > data.length) {
                        layer.msg("{{trans('goods::goods.combo_product_less_quantity')}}", {icon:2});
                        return false;
                    }

                    layer.close(index);
                    layer.open({
                        type: 2,
                        area: ['80%', '80%'],
                        fix: false,
                        skin: 'layui-layer-rim',
                        maxmin: true,
                        shade: 0.5,
                        anim: 4,
                        title: "{{trans('goods::goods.add_combo')}}",
                        btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                        yes: function (index) {
                            var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                            var load_index = layer.load();
                            $.ajax({
                                method: "post",
                                url: "{{route('goods::goods.create_or_update_combo')}}",
                                data: data,
                                success: function (data) {
                                    layer.close(load_index);
                                    if ('success' == data.status) {
                                        layer.close(index);
                                        layer.msg("{{trans('goods::goods.goods_create_or_update_successful')}}", {icon:1});
                                        parent.location.reload();
                                    } else {
                                        layer.msg("{{trans('goods::goods.goods_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                        content: "{{route('goods::goods.create_or_update_combo_page')}}?action=create&" + dataForm.serialize()
                    });
                },
                content: "{{route('goods::goods.choose_combo_product_page')}}"
            });
        }

        $(function () {
            $('#add_goods').parents('.btn-group').on('mouseenter', function () {
                var buttons = '';
                buttons += '<button type="button" class="btn btn-primary" onclick="addSinglePage();">@lang("goods::goods.single")</button>';
                buttons += '<button type="button" class="btn btn-primary" onclick="addComboPage();">@lang("goods::goods.combo")</button>';
                $(this).append(buttons);
            });
            $('#add_goods').parents('.btn-group').on('mouseleave', function () {
                $(this).children(':not(:first)').remove();
            });
            
            $('.edit_goods').on('click', function () {
                var goods_type = $(this).parents('tr').attr('data-type');
                var goods_id = $(this).parents('tr').attr('data-id');

                if ("{{\App\Modules\Goods\Models\Goods::SINGLE}}" == goods_type) {
                    layer.open({
                        type: 2,
                        area: ['80%', '80%'],
                        fix: false,
                        skin: 'layui-layer-rim',
                        maxmin: true,
                        shade: 0.5,
                        anim: 4,
                        title: "{{trans('goods::goods.edit_single')}}",
                        btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                        yes: function (index) {
                            var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                            var load_index = layer.load();
                            $.ajax({
                                method: "post",
                                url: "{{route('goods::goods.create_or_update_single')}}",
                                data: data,
                                success: function (data) {
                                    layer.close(load_index);
                                    if ('success' == data.status) {
                                        layer.close(index);
                                        layer.msg("{{trans('goods::goods.goods_create_or_update_successful')}}", {icon:1});
                                        parent.location.reload();
                                    } else {
                                        layer.msg("{{trans('goods::goods.goods_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                        content: "{{route('goods::goods.create_or_update_single_page')}}?action=update&goods_id=" + goods_id
                    });
                }
            });
        });
    </script>
@endsection