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
                    <h5 class="box-title">@lang('product::product.base_info')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-2" style="text-align: center">
                            <input type="hidden" name="image_link" value="{{$product_info->image_link or ''}}">
                            <div class="img_container">
                                <img src="{{$product_info->image_link or ''}}" onerror="this.src='{{asset('/assets/img/system/none.jpg')}}';this.onerror=null;">
                            </div>
                            <div class="form-group" style="margin-top: 15px;">
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('product::product.product_code')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="code" class="form-control" value="{{$product_info->code or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('product::product.product_name')</label>
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
                                <label class="col-xs-3 control-label required">@lang('product::product.category')</label>
                                <div class="col-xs-9">
                                    <select name="category_id" class="form-control select2">
                                        <option value="">@lang('product::product.please_select_category')</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(isset($product_info) && $product_info->category_id == $category->id) selected @endif>
                                                {{$category->display_name}}
                                            </option>
                                            @if(isset($category->children) && $category->children)
                                                @foreach($category->children as $son)
                                                    <option value="{{$son->id}}" @if(isset($product_info) && $product_info->category_id == $son->id) selected @endif>
                                                        {{str_repeat('&nbsp;', 4)}}{{$son->display_name}}
                                                    </option>
                                                    @if(isset($son->children) && $son->children)
                                                        @foreach($son->children as $grandson)
                                                            <option value="{{$grandson->id}}" @if(isset($product_info) && $product_info->category_id == $grandson->id) selected @endif>
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
                    <h5 class="box-title">@lang('product::product.product_attribute')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-xs-6">
                        <table id="product_attributes_table" class="table table-hover">
                            <thead>
                            <th>@lang('product::product.attribute_name')</th>
                            <th>@lang('product::product.is_required')</th>
                            </thead>
                            <tbody>
                                @if('update' == $action)
                                    @foreach($product_info->attributes as $product_attribute)
                                        <tr data-attribute_flag="{{$product_attribute->id}}" class="product_attribute_tr">
                                            <td><input type="text" name="product_attributes[{{$product_attribute->id}}][name]" class="form-control attribute_input" value="{{$product_attribute->name or ''}}"></td>
                                            <td><input type="checkbox" class="minimal" name="product_attributes[{{$product_attribute->id}}][is_required]" value="1" @if(1 == $product_attribute->is_required) checked @endif></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix no-border">
                    <button id="add_attribute" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('product::product.add_attribute')</button>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('product::product.sku_list')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table id="sku_list_table" class="table table-hover">
                        <thead class="sku_list_title">
                            <th class="required">@lang('product::product.sku_code')</th>
                            <th>@lang('product::product.weight')</th>
                            <th class="required">@lang('product::product.cost_price')</th>
                            @if('update' == $action)
                                @foreach($product_info->attributes as $product_attribute)
                                    <th class="{{$product_attribute->id}} @if(1 == $product_attribute->is_required) required @endif">
                                        {{$product_attribute->name}}
                                    </th>
                                @endforeach
                            @endif
                        </thead>
                        <tbody>
                        @if('update' == $action)
                            @foreach($product_info->skus as $product_sku)
                                <tr class="sku_list_tr" data-sku_flag="{{$product_sku->id}}">
                                    <td><input type="text" name="skus[{{$product_sku->id}}][code]" class="form-control" value="{{$product_sku->code or ''}}"></td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" name="skus[{{$product_sku->id}}][weight]" class="form-control" value="{{$product_sku->weight or ''}}">
                                            <span class="input-group-addon">g</span>
                                        </div>
                                    </td>
                                    <td><input type="text" name="skus[{{$product_sku->id}}][cost_price]" class="form-control" value="{{$product_sku->cost_price or ''}}"></td>
                                    @foreach($product_info->attributes as $product_attribute)
                                        <td class="{{$product_attribute->id}}">
                                            <input type="text" name="skus[{{$product_sku->id}}][attributes][{{$product_attribute->id}}]" class="form-control"
                                                @foreach($product_sku->attributeValues as $attribute_value)
                                                    @if($product_attribute->id == $attribute_value->attribute_id)
                                                        value="{{$attribute_value->value}}"
                                                    @endif
                                                @endforeach
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix no-border">
                    <button id="add_sku" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('product::product.add_sku')</button>
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
                uploadUrl: "{{route('product::product.upload')}}",
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

            // 添加属性
            $('#add_attribute').on('click', function () {
                var attribute_flag = Date.now();
                // 添加属性行
                var html = '';
                html += '<tr data-attribute_flag="' + attribute_flag + '"  class="product_attribute_tr">';
                html += '<td><input type="text" name="product_attributes[' + attribute_flag + '][name]" class="form-control attribute_input"></td>';
                html += '<td><input type="checkbox" class="minimal" name="product_attributes[' + attribute_flag + '][is_required]" value="1"></td>';
                html += '</tr>';
                $('#product_attributes_table>tbody').append(html);

                // iCkeck样式
                $('input[type="checkbox"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue'
                });

                // sku列表添加相应的行
                $('.sku_list_title>tr').append('<th class="' + attribute_flag + '"></th>');
                $('.sku_list_tr').each(function () {
                    var sku_flag = $(this).attr('data-sku_flag');
                    $(this).append('<td class="' + attribute_flag + '"><input type="text" name="skus[' + sku_flag + '][attributes][' + attribute_flag + ']" class="form-control"></td>');
                });

                // 右键菜单
                $.contextMenu({
                    selector: '.product_attribute_tr',
                    items: {
                        'update': {
                            name: '删除',
                            callback: function (key, opt) {
                                var attribute_flag = $(this).parents('tr').attr('data-attribute_flag');
                                $(this).remove();
                                $('th.' + attribute_flag).remove();
                                $('td.' + attribute_flag).remove();
                            }
                        }
                    }
                });

                // is_required事件
                $('.product_attribute_tr input:checkbox').on('ifChecked', function () {
                    var attribute_flag = $(this).parents('.product_attribute_tr').attr('data-attribute_flag');
                    $('.sku_list_title').find('th.' + attribute_flag).addClass('required');
                });
                $('.product_attribute_tr input:checkbox').on('ifUnchecked', function () {
                    var attribute_flag = $(this).parents('.product_attribute_tr').attr('data-attribute_flag');
                    $('.sku_list_title').find('th.' + attribute_flag).removeClass('required');
                });

                // 绑定事件
                $('.attribute_input').on('keyup', function () {
                    var attribute_name = $(this).val();
                    var attribute_flag = $(this).parents('tr').attr('data-attribute_flag');
                    $('.sku_list_title>tr>th.' + attribute_flag).html(attribute_name);
                });
            });

            // 添加sku
            $('#add_sku').on('click', function () {
                var sku_flag = Date.now();
                var html = '';
                html += '<tr class="sku_list_tr" data-sku_flag="' + sku_flag + '">';
                html += '<td><input type="text" name="skus[' + sku_flag + '][code]" class="form-control"></td>';    // sku编码
                // 重量
                html += '<td>';
                html += '<div class="input-group">';
                html += '<input type="text" name="skus[' + sku_flag + '][weight]" class="form-control">';
                html += '<span class="input-group-addon">g</span>';
                html += '</div>';
                html += '</td>';
                html += '<td><input type="text" name="skus[' + sku_flag + '][cost_price]" class="form-control"></td>'; // 成本价
                // 自定义属性
                $('#product_attributes_table').children('tbody').children('tr').each(function () {
                    var attribute_flag = $(this).attr('data-attribute_flag');
                    html += '<td class="' + attribute_flag + '"><input type="text" name="skus[' + sku_flag + '][attributes][' + attribute_flag + ']" class="form-control"></td>';
                });
                html += '</tr>';

                $('#sku_list_table>tbody').append(html);

                $.contextMenu({
                    selector: '.sku_list_tr',
                    items: {
                        'update': {
                            name: '删除',
                            callback: function (key, opt) {
                                $(this).remove();
                            }
                        }
                    }
                });
            });

            // 右键菜单
            $.contextMenu({
                selector: '.product_attribute_tr',
                items: {
                    'delete': {
                        name: "{{trans('application.delete')}}",
                        callback: function (key, opt) {
                            var attribute_flag = $(this).attr('data-attribute_flag');
                            $(this).remove();
                            $('th.' + attribute_flag).remove();
                            $('td.' + attribute_flag).remove();
                        }
                    }
                }
            });
            $.contextMenu({
                selector: '.sku_list_tr',
                items: {
                    'delete': {
                        name: "{{trans('application.delete')}}",
                        callback: function (key, opt) {
                            $(this).remove();
                        }
                    }
                }
            });
        });
    </script>
@endsection