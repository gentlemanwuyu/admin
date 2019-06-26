@extends('layouts.template')
@section('css')
    <style>
        td, th{
            vertical-align: middle!important;
        }
    </style>
@endsection
@section('body')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="col-xs-4 pull-right">
                <form>
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" value="{{$search or ''}}" placeholder="{{trans('application.search')}}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            <form>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">@lang('application.index_number')</th>
                        <th rowspan="2">@lang('product::product.product_code')</th>
                        <th rowspan="2">@lang('product::product.product_name')</th>
                        <th rowspan="2">@lang('product::product.category')</th>
                        <th colspan="3">@lang('product::product.sku_list')</th>
                        <th rowspan="2">@lang('application.select')</th>
                    </tr>
                    <tr>
                        <th>@lang('product::product.sku_code')</th>
                        <th>@lang('product::product.weight')</th>
                        <th>@lang('product::product.cost_price')</th>
                    </tr>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $products->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($products as $product)
                        <?php
                            $sku_numbers = $product->skus->count();
                            if (!$sku_numbers) {
                                $sku_numbers = 1;
                            }
                        ?>
                        <tr data-id="{{$product->id}}">
                            <td rowspan="{{$sku_numbers}}">{{$i++}}</td>
                            <td rowspan="{{$sku_numbers}}"><a href="{{route('product::product.product_detail', ['id' => $product->id])}}" target="_blank">{{$product->code or ''}}</a></td>
                            <td rowspan="{{$sku_numbers}}">{{$product->name or ''}}</td>
                            <td rowspan="{{$sku_numbers}}">{{$product->category->name or ''}}</td>
                            <?php
                            $first_sku = $product->skus->shift();
                            ?>
                            @if(empty($first_sku))
                                <td colspan="3"></td>
                            @else
                                <td>{{$first_sku->code or ''}}</td>
                                <td>{{$first_sku->weight or ''}}</td>
                                <td>{{$first_sku->cost_price or ''}}</td>
                            @endif
                            <td rowspan="{{$sku_numbers}}">
                                <div class="form-group" style="margin: 0;">
                                    <label>
                                        <input type="radio" name="product_id" class="minimal" value="{{$product->id}}">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @if(!$product->skus->isEmpty())
                            @foreach($product->skus as $sku)
                                <tr>
                                    <td>{{$sku->code or ''}}</td>
                                    <td>{{$sku->weight or ''}}</td>
                                    <td>{{$sku->cost_price or ''}}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </table>
            </form>
        </div>
        <div class="box-footer clearfix">
            {{$products->links()}}
        </div>
    </div>
@endsection