@extends('layouts.default')
@section('title')
    {{trans('template.product_list')}} | {{$project_name}}
@endsection
@section('css')
    <style>
        td {
            vertical-align: middle!important;
        }
        td.sku_list {
            padding: 0!important;
        }
        .sku_list>table {
            margin: 0;
        }
    </style>
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
                <table class="table table-bordered table-hover">
                    <thead>
                    <th>@lang('application.index_number')</th>
                    <th>@lang('application.image')</th>
                    <th>@lang('product::product.product_code')</th>
                    <th>@lang('product::product.product_name')</th>
                    <th>@lang('product::product.category')</th>
                    <th>@lang('product::product.sku_list')</th>
                    <th>@lang('application.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $products->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($products as $product)
                        <tr data-id="{{$product->id}}">
                            <td>{{$i++}}</td>
                            <td><img src="{{$product->image_link}}" alt="" style="max-width: 100px;height: auto;"></td>
                            <td><a href="{{route('product::product.detail', ['id' => $product->id])}}" target="_blank">{{$product->code or ''}}</a></td>
                            <td>{{$product->name or ''}}</td>
                            <td>{{$product->category->name or ''}}</td>
                            <td class="sku_list">
                                @if(!$product->skus->isEmpty())
                                    <table class="table table-bordered">
                                        <tr style="background: #3c8dbc; color: white;">
                                            <td>@lang('product::product.sku_code')</td>
                                            <td>@lang('product::product.weight')</td>
                                            <td>@lang('product::product.cost_price')</td>
                                            @if(!$product->attributes->isEmpty())
                                                @foreach($product->attributes as $attribute)
                                                    <td>{{$attribute->name}}</td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        @foreach($product->skus as $sku)
                                            <tr>
                                                <td>{{$sku->code or ''}}</td>
                                                <td>{{$sku->weight or ''}}</td>
                                                <td>{{$sku->cost_price or ''}}</td>
                                                @if(!$product->attributes->isEmpty())
                                                    @foreach($product->attributes as $attribute)
                                                        <td>
                                                            @foreach($sku->attributeValues as $attributeValue)
                                                                @if($attributeValue->attribute_id == $attribute->id)
                                                                    {{$attributeValue->value or ''}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_product" title="{{trans('product::product.edit_product')}}"></i>
                                </a>
                                <a href="javascript:;">
                                    <i class="fa fa-trash delete_product" title="{{trans('product::product.delete_product')}}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{$products->links()}}
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            // 添加产品
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
                            url: "{{route('product::product.create_or_update_product')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('product::product.product_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('product::product.product_create_or_update_fail')}}:"+data.msg, {icon:2});
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

            // 编辑产品
            $('.edit_product').on('click', function () {
                var product_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['80%', '80%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('product::product.edit_product')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('product::product.create_or_update_product')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('product::product.product_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('product::product.product_create_or_update_fail')}}:"+data.msg, {icon:2});
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
                    content: "{{route('product::product.create_or_update_product_page')}}?action=update&product_id=" + product_id
                });
            });

            // 删除产品
            $('.delete_product').on('click', function () {
                var product_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('product::product.product_delete_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('product::product.delete_product')}}",
                        data: {product_id: product_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('product::product.product_delete_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('product::product.product_delete_fail')}}"+data.msg, {icon:2});
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