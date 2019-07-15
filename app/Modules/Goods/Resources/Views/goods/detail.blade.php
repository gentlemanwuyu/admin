@extends('layouts.default')
@section('title')
    @lang('goods::goods.goods_detail') | {{$project_name}}
@endsection
@section('css')
    <style>
        img {
            width: 200px;
            height: auto;
            border: 1px solid #3c8dbc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 0;
        }
        #related_products_table td {
            text-align: left;
        }
        #related_products_table tr:first-child td {
            border-top: 0;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('goods::goods.goods_detail')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cubes"></i>@lang('template.goods_management')</a></li>
            <li class="active">@lang('goods::goods.goods_detail')</li>
        </ol>
    </section>
    <section class="content">
        <form class="form-horizontal">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('goods::goods.base_info')</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="{{$goods_info->image_link or ''}}" onerror="this.src='{{asset('/assets/img/system/none.jpg')}}';this.onerror=null;">
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('goods::goods.goods_code')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$goods_info->code or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('goods::goods.goods_name')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$goods_info->name or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.description')</label>
                                <div class="col-xs-9">
                                    <div class="form-control-div">
                                        {{$goods_info->description or ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('goods::goods.category')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$goods_info->category->name or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('goods::goods.type')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">@lang('goods::goods.'.$goods_info->type_name)</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label" style="vertical-align: middle;">
                                    @lang('goods::goods.related_product')
                                    @if(\App\Modules\Goods\Models\Goods::COMBO == $goods_info->type)
                                        <i class="fa fa-plus-square-o" id="unfold_combo_product" style="color: #dd4b39; margin-left: 2px;"></i>
                                    @endif
                                </label>
                                <div class="col-xs-9">
                                    <?php
                                        $product = $goods_info->getProduct();
                                        $i = 1;
                                    ?>
                                    @if(\App\Modules\Goods\Models\Goods::SINGLE == $goods_info->type)
                                            <span class="form-control-span"><a href="{{route('product::product.detail', ['id' => $product->id])}}" target="_blank">{{$product->name or ''}}</a></span>
                                    @elseif(\App\Modules\Goods\Models\Goods::COMBO == $goods_info->type)
                                        <table id="related_products_table" class="table">
                                            <tbody>
                                            @foreach($product as $p)
                                                <tr class="related_product" @if(1 != $i++) style="display: none;" @endif>
                                                    <td><a href="{{route('product::product.detail', ['id' => $p->id])}}" target="_blank">{{$p->name}}</a></td>
                                                    <td>{{$p->quantity}}@lang('application.pcs')</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('goods::goods.sku_list')</div>
                <div class="panel-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>@lang('goods::goods.sku_code')</th>
                        <th class="th_list">
                            <div class="row th_content_div">
                                @lang('goods::goods.product_sku')
                            </div>
                            @if(\App\Modules\Goods\Models\Goods::COMBO == $goods_info->type)
                                <div class="row">
                                    <div class="col-xs-6 th_content_div">@lang('goods::goods.product')</div>
                                    <div class="col-xs-3 th_content_div">@lang('goods::goods.product_sku')</div>
                                    <div class="col-xs-3 th_content_div">@lang('application.quantity')</div>
                                </div>
                            @endif
                        </th>
                        <th>@lang('goods::goods.cost_price')</th>
                        <th>@lang('goods::goods.lowest_price')</th>
                        <th>@lang('goods::goods.msrp')</th>
                        </thead>
                        <tbody>
                            @foreach($goods_info->skus as $goods_sku)
                                <tr>
                                    <td>{{$goods_sku->code}}</td>
                                    <td class="td_list">
                                        @if(\App\Modules\Goods\Models\Goods::SINGLE == $goods_info->type)
                                            {{$goods_sku->getProductSku()->code}}
                                        @elseif(\App\Modules\Goods\Models\Goods::COMBO == $goods_info->type)
                                            <table class="table table-bordered table-hover">
                                                @foreach($goods_sku->getProductSku() as $product_sku)
                                                    <tr>
                                                        <td class="col-xs-6">
                                                            <a href="{{route('product::product.detail', ['id' => $product_sku->product->id])}}" target="_blank">{{$product_sku->product->name}}</a>

                                                        </td>
                                                        <td class="col-xs-3">{{$product_sku->code}}</td>
                                                        <td class="col-xs-3">{{$product_sku->quantity}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                    </td>
                                    <td>{{$goods_sku->cost_price}}</td>
                                    <td>{{$goods_sku->lowest_price}}</td>
                                    <td>{{$goods_sku->msrp}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#unfold_combo_product').on('click', function () {
                if ($(this).hasClass('fa-plus-square-o')) {
                    $(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                    $(this).parents('div.form-group').find('.table>tbody>tr').show();
                }else {
                    $(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
                    $(this).parents('div.form-group').find('.table>tbody>tr:not(:first-child)').hide();
                }
            });
        });
    </script>
@endsection