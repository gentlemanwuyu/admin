@extends('layouts.template')
@section('css')
    <style>

    </style>
@endsection
@section('body')
    <div class="row" style="margin: 0;">
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="products">
                        <thead>
                        <tr>
                            <th>@lang('application.index_number')</th>
                            <th>@lang('product::product.product_code')</th>
                            <th>@lang('product::product.product_name')</th>
                            <th>@lang('product::product.category')</th>
                            <th class="multi-th" width="40%">
                                <div>@lang('product::product.sku_list')</div>
                                <ul class="list-inline">
                                    <li class="col-xs-6">@lang('product::product.sku_code')</li>
                                    <li class="col-xs-3">@lang('product::product.weight')</li>
                                    <li class="col-xs-3">@lang('product::product.cost_price')</li>
                                </ul>
                            </th>
                            <th>@lang('application.select')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <form>
                <div class="panel panel-primary">
                    <div class="panel-heading">@lang('goods::goods.selected_product')</div>
                    <div class="panel-body">
                        <table class="table table-hover" id="selected_products">
                            <thead>
                            <tr>
                                <th width="20">@lang('application.index_number')</th>
                                <th width="50%">@lang('goods::goods.product')</th>
                                <th width="30%">@lang('application.quantity')</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            var opts = defaultDataTablesOptions;
            opts.ordering = false;
            opts.ajax.url = "{{route('goods::goods.get_products', ['type' => \App\Modules\Goods\Models\Goods::COMBO])}}";
            opts.columns = [
                {
                    "data": function (row, type, set, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": 'code'
                },
                {
                    "data": 'name'
                },
                {
                    "data": 'category'
                },
                {
                    "className": "multi-td",
                    "render": function (row, type, set, meta) {
                        var html = '';
                        $.each(set.skus, function (key, val) {
                            html += '<ul class="list-inline">';
                            html += '<li class="col-xs-6">' + val.code + '</li>';
                            html += '<li class="col-xs-3">' + val.weight + '</li>';
                            html += '<li class="col-xs-3">' + val.cost_price + '</li>';
                            html += '</ul>';
                        });

                        return html;
                    }
                },
                {
                    "render": function (row, type, set, meta) {
                        var html = '';
                        html += '<div class="form-group" style="margin: 0;">';
                        html += '<label>';
                        html += '<input type="checkbox" id="product_checkbox_' + set.id + '" class="minimal select_product" data-id="' + set.id + '" data-code="' + set.code + '" data-name="' + set.name + '">';
                        html += '</label>';
                        html += '</div>';

                        return html;
                    }
                }
            ];
            opts.drawCallback = function (settings, json) {
                // 表格加载完数据后，初始化radio效果
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass   : 'iradio_minimal-blue'
                });

                $('input.select_product').on('ifChanged', function () {
                    var product_id = $(this).attr('data-id');
                    var product_code = $(this).attr('data-code');
                    var product_name = $(this).attr('data-name');
                    if (this.checked) {
                        // 判断产品是否已经添加过
                        var product_exists = $('#selected_products>tbody').find('tr#product_' + product_id).length;
                        if (product_exists) {
                            layer.alert('{{trans('goods::goods.product_added')}}');
                            return false;
                        }

                        // 计算序号
                        var selected_number = $('#selected_products>tbody>tr').length;

                        var html = '';
                        html += '<tr class="selected_product_tr" id="product_' + product_id + '" data-id="' + product_id + '">';
                        html += '<td>' + (selected_number + 1) + '</td>';
                        html += '<td>' + product_code + '<br>' + product_name + '</td>';
                        html += '<td><input type="text" class="form-control" name="selected_products[' + product_id + ']" oninput="value=value.replace(/[^\\d]/g, \'\')"></td>';
                        html += '</tr>';
                        $('#selected_products>tbody').append(html);
                    }else {
                        $('#product_' + product_id).remove();
                        // 序号重新排
                        var new_index = 1;
                        $('#selected_products>tbody>tr').each(function () {
                            $(this).find('td:first-child').html(new_index++);
                        });
                    }

                    // 右键菜单
                    $.contextMenu({
                        selector: '.selected_product_tr',
                        items: {
                            "delete": {
                                "name": "{{trans('application.delete')}}",
                                "callback": function (key, opt) {
                                    var product_id = $(this).attr('data-id');
                                    $(this).remove();
                                    // 序号重新排
                                    var new_index = 1;
                                    $('#selected_products>tbody>tr').each(function () {
                                        $(this).find('td:first-child').html(new_index++);
                                    });

                                    //取消表格中复选框的打勾
                                    $('#product_checkbox_' + product_id).iCheck('uncheck');
                                }
                            }
                        }
                    });
                });
            };

            $('#products').DataTable(opts);
        });
    </script>
@endsection