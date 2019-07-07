@extends('layouts.default')
@section('title')
    @lang('product::product.product_detail') | {{$project_name}}
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
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('product::product.product_detail')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cubes"></i>@lang('template.product_management')</a></li>
            <li class="active">@lang('product::product.product_detail')</li>
        </ol>
    </section>
    <section class="content">
        <form class="form-horizontal">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('product::product.base_info')</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="{{$product_info->image_link or ''}}" onerror="this.src='{{asset('/assets/img/system/none.jpg')}}';this.onerror=null;">
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('product::product.product_code')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$product_info->code or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('product::product.product_name')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$product_info->name or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.description')</label>
                                <div class="col-xs-9">
                                    <div class="form-control-div">
                                        {{$product_info->description or ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('product::product.category')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$product_info->category->name or ''}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('product::product.sku_list')</div>
                <div class="panel-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>@lang('product::product.sku_code')</th>
                        <th>@lang('product::product.weight')</th>
                        <th>@lang('product::product.cost_price')</th>
                        @foreach($product_info->attributes as $product_attribute)
                            <th>{{$product_attribute->name}}</th>
                        @endforeach
                        </thead>
                        <tbody>
                        @foreach($product_info->skus as $product_sku)
                            <tr>
                                <td>{{$product_sku->code or ''}}</td>
                                <td>{{$product_sku->weight or ''}}g</td>
                                <td>{{$product_sku->cost_price or ''}}</td>
                                @foreach($product_info->attributes as $product_attribute)
                                    <?php
                                        $value = '--';
                                        foreach ($product_sku->attributeValues as $attribute_value) {
                                            if ($product_attribute->id == $attribute_value->attribute_id) {
                                                $value = $attribute_value->value;
                                            }
                                        }
                                    ?>
                                    <td>{{$value}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </section>
@endsection