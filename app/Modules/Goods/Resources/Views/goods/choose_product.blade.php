@extends('layouts.template')
@section('css')
    <style>
        td, th{
            vertical-align: middle!important;
        }
        .sku_list_th_td {
            padding: 0!important;
        }
        .sku_list_th_td > div.row {
            margin: 0;
        }
        .sku_list_th_td .col-xs-12, .sku_list_th_td .col-xs-4 {
            padding: 8px;
        }
        .sku_list_th_td > div.row > div.col-xs-4:not(:first-child) {
            border-left: 1px solid #f4f4f4;
        }

        .sku_list_th_td .row:not(:first-child){
            border-top: 1px solid #f4f4f4;
        }
    </style>
@endsection
@section('body')
    <div class="box box-primary">
        <div class="box-body">
            <form>
                <table class="table table-bordered" id="products">
                    <thead>
                    <tr>
                        <th>@lang('application.index_number')</th>
                        <th>@lang('product::product.product_code')</th>
                        <th>@lang('product::product.product_name')</th>
                        <th>@lang('product::product.category')</th>
                        <th class="sku_list_th_td">
                            <div class="row">
                                <div class="col-xs-12">@lang('product::product.sku_list')</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">@lang('product::product.sku_code')</div>
                                <div class="col-xs-4">@lang('product::product.weight')</div>
                                <div class="col-xs-4">@lang('product::product.cost_price')</div>
                            </div>
                        </th>
                        <th>@lang('application.select')</th>
                    </tr>
                    </thead>
                </table>
            </form>
        </div>
        <div class="box-footer clearfix">

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            var opts = defaultDataTablesOptions;
            opts.ajax.url = "{{route('goods::goods.get_products')}}";
            opts.columnDefs = [
                {
                    "targets": "_all",
                    "orderable": false
                }
            ];
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
                    "className": "sku_list_th_td",
                    "render": function (row, type, set, meta) {
                        var html = '';
                        $.each(set.skus, function (key, val) {
                            html += '<div class="row">';
                            html += '<div class="col-xs-4">' + val.code + '</div>';
                            html += '<div class="col-xs-4">' + val.weight + '</div>';
                            html += '<div class="col-xs-4">' + val.cost_price + '</div>';
                            html += '</div>';
                        });

                        return html;
                    }
                },
                {
                    "render": function (row, type, set, meta) {
                        var html = '';
                        html += '<div class="form-group" style="margin: 0;">';
                        html += '<label>';
                        html += '<input type="radio" name="product_id" class="minimal" value="' + set.id + '">';
                        html += '</label>';
                        html += '</div>';

                        return html;
                    }
                }
            ];
            opts.drawCallback = function (settings, json) {console.log(json);
                // 表格加载完数据后，初始化radio效果
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass   : 'iradio_minimal-blue'
                });
            };

            $('#products').DataTable(opts);
        });
    </script>
@endsection