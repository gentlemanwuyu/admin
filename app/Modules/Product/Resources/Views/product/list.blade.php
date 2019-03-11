@extends('layouts.default')
@section('title')
    {{trans('template.product_list')}} | {{$project_name}}
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.product_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cubes"></i>@lang('template.product_management')</a></li>
            <li class="active">@lang('template.product_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_product" type="button" class="btn btn-primary" title="{{trans('product::product.add_product')}}"><i class="fa fa-cube"></i></button>
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
        $(function () {
            $('#add_product').on('click', function () {
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('product::product.add_product')}}",
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
                    content: "{{route('product::product.create_or_update_product_page')}}?action=create"
                });
            });
        });
    </script>
@endsection