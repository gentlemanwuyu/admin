@extends('layouts.template')
@section('css')
    <style>

    </style>
@endsection
@section('body')
    <div class="box box-primary">
        <div class="box-body">
            <form>
                <table class="table table-bordered table-hover" id="products">
                    <thead>
                    <tr>
                        <th>@lang('application.index_number')</th>
                        <th>@lang('product::product.product_code')</th>
                        <th>@lang('product::product.product_name')</th>
                        <th>@lang('product::product.category')</th>
                        <th class="th_list">
                            <div class="row th_content_div">@lang('product::product.sku_list')</div>
                            <div class="row">
                                <div class="col-xs-4 th_content_div">@lang('product::product.sku_code')</div>
                                <div class="col-xs-4 th_content_div">@lang('product::product.weight')</div>
                                <div class="col-xs-4 th_content_div">@lang('product::product.cost_price')</div>
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
            opts.ordering = false;
            opts.ajax.url = "{{route('goods::goods.get_products')}}";
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
                    "className": "td_list",
                    "render": function (row, type, set, meta) {
                        var html = '';
                        html += '<table class="table table-bordered table-hover">';
                        $.each(set.skus, function (key, val) {
                            html += '<tr>';
                            html += '<td class="col-xs-4">' + val.code + '</td>';
                            html += '<td class="col-xs-4">' + val.weight + '</td>';
                            html += '<td class="col-xs-4">' + val.cost_price + '</td>';
                            html += '</tr>';
                        });
                        html += '</table>';

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
            opts.drawCallback = function (settings, json) {
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