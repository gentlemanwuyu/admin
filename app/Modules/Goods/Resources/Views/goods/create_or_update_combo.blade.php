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
        .product_sku_select_td>.table {
            margin: 0;
            border: 1px solid #f4f4f4;
        }
    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <input type="hidden" name="action" value="{{$action or 'create'}}">
        @if('create' == $action)
            @foreach($selected_products as $product_id => $quantity)
                <input type="hidden" name="selected_products[{{$product_id}}]" value="{{$quantity or ''}}">
            @endforeach
        @else
            <input type="hidden" name="goods_id" value="{{$goods_id or ''}}">
        @endif
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
                            <div class="img_container">
                                <input type="hidden" name="image_link" value="{{$goods_info->image_link or ''}}">
                                <img src="{{$goods_info->image_link or ''}}" onerror="this.src='{{asset('/assets/img/system/none.jpg')}}';this.onerror=null;">
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('goods::goods.goods_code')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="code" class="form-control" value="{{$goods_info->code or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('goods::goods.goods_name')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="name" class="form-control" value="{{$goods_info->name or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.description')</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="description" rows="3">{{$goods_info->description or ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('goods::goods.category')</label>
                                <div class="col-xs-9">
                                    <select name="category_id" class="form-control select2">
                                        <option value="">@lang('goods::goods.please_select_category')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if('update' == $action && $goods_info->category_id == $category->id) selected @endif>
                                                {{$category->display_name}}
                                            </option>
                                            @if(isset($category->children) && $category->children)
                                                @foreach($category->children as $son)
                                                    <option value="{{$son->id}}" @if('update' == $action && $goods_info->category_id == $son->id) selected @endif>
                                                        {{str_repeat('&nbsp;', 4)}}{{$son->display_name}}
                                                    </option>
                                                    @if(isset($son->children) && $son->children)
                                                        @foreach($son->children as $grandson)
                                                            <option value="{{$grandson->id}}" @if('update' == $action && $goods_info->category_id == $grandson->id) selected @endif>
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
                        <thead>
                        <tr>
                            <th class="required">@lang('goods::goods.sku_code')</th>
                            <th class="required">@lang('goods::goods.product_sku')</th>
                            <th>@lang('goods::goods.cost_price')</th>
                            <th class="required">@lang('goods::goods.lowest_price')</th>
                            <th>@lang('goods::goods.msrp')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($goods_info->skus as $goods_sku)
                                <tr class="sku_list_tr" data-sku_flag="{{$goods_sku->id}}">
                                    <td><input type="text" class="form-control" name="skus[{{$goods_sku->id}}][code]" value="{{$goods_sku->code}}"></td>
                                    <td class="product_sku_select_td">
                                        <table class="table">
                                            @foreach($products as $product)
                                                <tr>
                                                    <td style="width: 40%;">{{$product->name}}</td>
                                                    <td>
                                                        <select name="skus[{{$goods_sku->id}}][selected_product_skus][{{$product->id}}]" class="form-control">
                                                            <option value="">@lang('goods::goods.please_select_product_sku')</option>
                                                            @foreach($product->skus as $product_sku)
                                                                <option value="{{$product_sku->id}}" @if($product_sku->id == $goods_sku->getComboProductSkuId($product->id)) selected @endif>{{$product_sku->code}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width: 20%;">@lang('application.quantity'):{{$product->quantity}}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td><span class="form-control-span">0.28</span></td>
                                    <td><input type="text" class="form-control" name="skus[{{$goods_sku->id}}][lowest_price]" value="{{$goods_sku->lowest_price}}"></td>
                                    <td><input type="text" class="form-control" name="skus[{{$goods_sku->id}}][msrp]" value="{{$goods_sku->msrp}}"></td>
                                <tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix no-border">
                    <button id="add_sku" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('goods::goods.add_sku')</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(function () {
            var upload_layer_index;
            $('input:file').fileinput({
                showPreview: false,
                uploadUrl: "{{route('goods::goods.upload')}}",
                layoutTemplates: {progress: ''},
                removeLabel: '',
                uploadLabel: '',
                browseLabel: ''
            });
            $('input:file').on('filepreupload', function () {
                upload_layer_index = layer.load();
            });
            $('input:file').on('fileuploaded', function (event, data, previewId, index) {
                layer.close(upload_layer_index);
                $('div.kv-upload-progress').hide();
                if ('success' == data.response.status) {
                    $('img').attr('src', data.response.content);
                    $('input[name=image_link]').val(data.response.content);
                }else {
                    layer.msg("{{trans('product::product.image_upload_failed')}}:"+data.response.msg, {icon:2});
                }
            });

            // 添加sku
            $('#add_sku').on('click', function () {
                var sku_flag = Date.now();
                var html = '';
                html += '<tr class="sku_list_tr" data-sku_flag="' + sku_flag + '">';
                html += '<td><input type="text" class="form-control" name="skus[' + sku_flag + '][code]"></td>';
                html += '<td class="product_sku_select_td">';
                html += '<table class="table">';
                @foreach($products as $product)
                    html += '<tr>';
                    html += '<td style="width: 40%;">{{$product->name}}</td>';
                    html += '<td>';
                    html += '<select name="skus[' + sku_flag + '][selected_product_skus][{{$product->id}}]" class="form-control">';
                    html += '<option value="">@lang('goods::goods.please_select_product_sku')</option>';
                    @foreach($product->skus as $product_sku)
                        html += '<option value="{{$product_sku->id}}">{{$product_sku->code}}</option>';
                    @endforeach
                    html += '</select>';
                    html += '</td>';
                    html += '<td style="width: 20%;">@lang('application.quantity'):{{$product->quantity}}</td>';
                    html += '</tr>';
                @endforeach
                html += '</table>';
                html += '</td>';
                html += '<td><span class="form-control-span">0.28</span></td>';
                html += '<td><input type="text" class="form-control" name="skus[' + sku_flag + '][lowest_price]"></td>';
                html += '<td><input type="text" class="form-control" name="skus[' + sku_flag + '][msrp]"></td>';
                html += '</tr>';

                $('#sku_list_table>tbody').append(html);

                $.contextMenu({
                    selector: '.sku_list_tr',
                    items: {
                        'update': {
                            name: '@lang('application.delete')',
                            callback: function (key, opt) {
                                $(this).remove();
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection