@extends('layouts.default')
@section('title')
    {{trans('template.goods_list')}} | {{$project_name}}
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
                content: "{{route('goods::goods.choose_product_page')}}"
            });
        }

        function addComboPage(){

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
        });
    </script>
@endsection