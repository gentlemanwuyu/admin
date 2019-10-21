@extends('layouts.template')
@section('css')
    <style>
        .red {
            color: red;
        }
    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <table class="table table-hover">
            <thead>
            <th>sku</th>
            <th>@lang('product::product.actual_inventory')</th>
            <th>@lang('product::product.highest_inventory')</th>
            <th>@lang('product::product.lowest_inventory')</th>
            </thead>
            <tbody>
            @foreach($product_info->skus as $sku)
                <tr data-sku_id="{{$sku->id}}">
                    <td>{{$sku->code}}</td>
                    <td class="actual_inventory_td" data-ori_stock="{{$sku->inventory->stock or 0}}">
                        <span>{{$sku->inventory->stock or 0}}</span>
                    </td>
                    <td>
                        <input type="text" name="product_inventories[{{$sku->id}}][highest]" class="form-control" value="{{$sku->inventory->highest_quantity or ''}}" oninput="this.value=value.replace(/[^\d]/g, '')">
                    </td>
                    <td>
                        <input type="text" name="product_inventories[{{$sku->id}}][lowest]" class="form-control" value="{{$sku->inventory->lowest_quantity or ''}}" oninput="this.value=value.replace(/[^\d]/g, '')">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
@endsection
@section('scripts')
    <script>
        $(function () {
            $.contextMenu({
                selector: '.actual_inventory_td',
                items: {
                    'update': {
                        name: '@lang('product::product.update_actual_inventory')',
                        callback: function (key, opt) {
                            var td_obj = this;
                            // 原始库存
                            var ori_stock = $(this).attr('data-ori_stock');
                            var stock = $(this).find('span').html();
                            var sku_id = $(this).parents('tr').attr('data-sku_id');
                            layer.prompt({value: stock, title: "@lang('product::product.type_in_latest_inventory')"}, function(value, index, elem){
                                if (/^[0-9]+$/.test(value)) {
                                    layer.close(index);
                                    if (parseInt(value) == parseInt(ori_stock)) {
                                        $(td_obj).find('span').html(value);
                                        $(td_obj).find('input').remove();
                                        $(td_obj).find('span').removeClass('red');
                                    }else {
                                        $(td_obj).find('span').html(value);
                                        if (0 == $(td_obj).children('input').length) {
                                            $(td_obj).append('<input type="hidden" name="product_inventories[' + sku_id + '][actual]" value="' + value + '">');
                                        }else {
                                            $(td_obj).find('input').val(value);
                                        }
                                        $(td_obj).find('span').addClass('red');
                                    }
                                }else {
                                    layer.msg("@lang('product::product.inventory_numeric')", {icon:2});
                                }
                            });
                        }
                    }
                }
            });
        });
    </script>
@endsection