@extends('layouts.template')
@section('css')
    <style>
        img {
            width: 200px;
            height: auto;
        }
        .img_container {
            width: 212px;
            height: 212px;
            border: 1px solid #3c8dbc;
            padding: 5px;
            border-radius: 3px;
            display: table-cell;
            vertical-align: middle;
        }
    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <div class="row" style="padding: 30px;">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('goods::goods.base_info')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-2" style="text-align: center">
                            <input type="hidden" name="action" value="{{$action or 'create'}}">
                            @if('create' == $action)
                                <input type="hidden" name="product_id" value="{{$product_id}}">
                            @else
                                <input type="hidden" name="goods_id" value="{{$goods_id}}">
                            @endif
                            <div class="img_container">
                                <img src="{{$product_info->image_link or ''}}" onerror="this.src='{{asset('/assets/img/system/none.jpg')}}';this.onerror=null;">
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('goods::goods.goods_code')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="code" class="form-control" value="{{$product_info->code or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('goods::goods.goods_name')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="name" class="form-control" value="{{$product_info->name or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.description')</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="description" rows="3">{{$product_info->description or ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('goods::goods.category')</label>
                                <div class="col-xs-9">
                                    <select name="category_id" class="form-control select2">
                                        <option value="">@lang('goods::goods.please_select_category')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if('update' == $action && isset($product_info) && $product_info->category_id == $category->id) selected @endif>
                                                {{$category->display_name}}
                                            </option>
                                            @if(isset($category->children) && $category->children)
                                                @foreach($category->children as $son)
                                                    <option value="{{$son->id}}" @if('update' == $action && isset($product_info) && $product_info->category_id == $son->id) selected @endif>
                                                        {{str_repeat('&nbsp;', 4)}}{{$son->display_name}}
                                                    </option>
                                                    @if(isset($son->children) && $son->children)
                                                        @foreach($son->children as $grandson)
                                                            <option value="{{$grandson->id}}" @if('update' == $action && isset($product_info) && $product_info->category_id == $grandson->id) selected @endif>
                                                                {{str_repeat('&nbsp;', 8)}}{{$grandson->display_name}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('goods::goods.sku_list')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table id="sku_list_table" class="table table-hover">
                        <thead class="sku_list_title">
                        <th><label style="margin: 0;"><input type="checkbox" class="minimal my-check-all" data-check_class="goods_sku_checkbox">&nbsp;&nbsp;@lang('application.select_all')</label></th>
                        <th class="required">@lang('goods::goods.sku_code')</th>
                        <th>@lang('goods::goods.cost_price')</th>
                        <th class="required">@lang('goods::goods.lowest_price')</th>
                        <th>@lang('goods::goods.msrp')</th>
                        </thead>
                        <tbody>
                        @foreach($product_info->skus as $product_sku)
                            <tr>
                                <td>
                                    <label><input type="checkbox" class="minimal goods_sku_checkbox" name="skus[{{$product_sku->id}}][enabled]" value="1"></label>
                                </td>
                                <td><input type="text" name="skus[{{$product_sku->id}}][code]" class="form-control" value="{{$product_sku->code or ''}}"></td>
                                <td><span class="form-control-span">{{$product_sku->cost_price or ''}}</span></td>
                                <td><input type="text" name="skus[{{$product_sku->id}}][lowest_price]" class="form-control" value="" oninput="value=value.replace(/[^\d.]/g, '')"></td>
                                <td><input type="text" name="skus[{{$product_sku->id}}][msrp]" class="form-control" value="" oninput="value=value.replace(/[^\d.]/g, '')"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix no-border">

                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(function () {
            // sku未选中时，禁用该sku所有input框和select框
            $('.goods_sku_checkbox').each(function () {
                $(this).parents('tr').find('input, select').not($(this)).prop('disabled', !this.checked);
                $('.goods_sku_checkbox').on('ifChanged', function () {
                    $(this).parents('tr').find('input, select').not($(this)).prop('disabled', !this.checked);
                });
            });
        });
    </script>
@endsection