@extends('layouts.template')
@section('css')
    <style>

    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <div class="row" style="padding: 30px;">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('application.base_info')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <input type="hidden" name="action" value="{{$action or 'create'}}">
                    @if('update' == $action)
                        <input type="hidden" name="supplier_id" value="{{$supplier_id}}">
                    @endif
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('application.name')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('supplier::supplier.supplier_code')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="code" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.company')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="company" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.phone')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="phone" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.fax')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="fax" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('application.country')</label>
                                <div class="col-xs-9">
                                    <select name="country_code" class="form-control select2">
                                        <option value="">@lang('supplier::supplier.please_select_country')</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country['abbreviation']}}" @if(isset($supplier_info) && $supplier_info->country_code == $country['abbreviation'] || !isset($supplier_info) && 'CN' == $country['abbreviation']) selected @endif>
                                                {{$country['zh_name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.address')</label>
                                <div class="col-xs-9">
                                    <div id="chinese_address" class="row">
                                        <div id="state" class="col-xs-4">
                                            <select name="state_id" class="form-control select2" style="width: 100%;">
                                                <option value="">@lang('supplier::supplier.please_select_state')</option>
                                                @foreach($chinese_regions as $region)
                                                    <option value="{{$region['id']}}">{{$region['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="city" class="col-xs-4" style="display: none;">
                                            <select name="city_id" class="form-control select2" style="width: 100%;">
                                                <option value="">@lang('supplier::supplier.please_select_city')</option>
                                                @foreach($chinese_regions as $region)
                                                    <option value="{{$region['id']}}">{{$region['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="county" class="col-xs-4" style="display: none;">
                                            <select name="county_id" class="form-control select2" style="width: 100%;">
                                                <option value="">@lang('supplier::supplier.please_select_county')</option>
                                                @foreach($chinese_regions as $region)
                                                    <option value="{{$region['id']}}">{{$region['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="street_address" class="col-xs-12" style="margin-top: 10px;display: none;">
                                            <input type="text" name="street_address" class="form-control" value="" placeholder="请输入街道地址">
                                        </div>
                                    </div>
                                    <div id="other_address" class="row" @if('create' == $action) style="display: none;" @endif>
                                        <div class="col-xs-12">
                                            <input type="text" name="address" class="form-control" value="" placeholder="请输入详细地址">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.introduction')</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="introduction" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('application.contact')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="contacts_table" class="table table-hover">
                        <thead>
                        <th class="required">@lang('application.name')</th>
                        <th>@lang('application.position')</th>
                        <th class="required">@lang('application.phone')</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix no-border">
                    <button id="add_contact" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('supplier::supplier.add_contact')</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        var chinese_regions = {
            @foreach($chinese_regions as $state_id => $state)
                "{{$state_id}}": {
                    "id": "{{$state['id']}}",
                    @if(isset($state['children']))
                    "children": {
                        @foreach($state['children'] as $city_id => $city)
                            "{{$city_id}}": {
                                "id": "{{$city['id']}}",
                                @if(isset($city['children']))
                                "children": {
                                    @foreach($city['children'] as $county_id => $county)
                                        "{{$county_id}}": {
                                            "id": "{{$county['id']}}",
                                            "name": "{{$county['name']}}"
                                        },
                                    @endforeach
                                },
                                @endif
                                "name": "{{$city['name']}}"
                            },
                        @endforeach
                    },
                    @endif
                    "name": "{{$state['name']}}"
                },
            @endforeach
        };
        $(function () {
            // 选择国家change事件
            $('select[name=country_code]').on('change', function () {
                if ('CN' == this.value) {
                    $('#other_address').hide();
                    $('#chinese_address').show();
                }else {
                    $('#other_address').show();
                    $('#chinese_address').hide();
                }
                $('select[name=state_id]').select2('val', ['']);
            });

            // 选择省份change事件
            $('select[name=state_id]').on('change', function () {
                $('select[name=city_id]').select2('val', ['']);
                $('#city').hide();
                if (this.value) {
                    var cities = chinese_regions[this.value]['children'];
                    if (cities) {
                        var html = '';
                        html += '<option value="">@lang('supplier::supplier.please_select_city')</option>';
                        $.each(cities, function (city_id, city) {
                            html += '<option value="' + city.id + '">' + city.name + '</option>';
                        });
                        $('select[name=city_id]').html(html);
                        $('#city').show();
                    }else {
                        $('input[name=street_address]').val('');
                        $('#street_address').show();
                    }
                }
            });

            // 选择城市change事件
            $('select[name=city_id]').on('change', function () {
                $('select[name=county_id]').select2('val', ['']);
                $('#county').hide();
                if (this.value) {
                    var state_id = $('select[name=state_id]').val();
                    var counties = chinese_regions[state_id]['children'][this.value]['children'];
                    if (counties) {
                        var html = '';
                        html += '<option value="">@lang('supplier::supplier.please_select_county')</option>';
                        $.each(counties, function ($county_id, $county) {
                            html += '<option value="' + $county.id + '">' + $county.name + '</option>';
                        });
                        $('select[name=county_id]').html(html);
                        $('#county').show();
                    }else {
                        $('input[name=street_address]').val('');
                        $('#street_address').show();
                    }
                }
            });

            // 选择县区change事件
            $('select[name=county_id]').on('change', function () {
                $('input[name=street_address]').val('');
                if (this.value) {
                    $('#street_address').show();
                }else {
                    $('#street_address').hide();
                }
            });

            // 添加sku
            $('#add_contact').on('click', function () {
                var contact_flag = Date.now();
                var html = '';
                html += '<tr class="contact_tr" data-contact_flag="' + contact_flag + '">';
                html += '<td><input type="text" name="contacts[' + contact_flag + '][name]" class="form-control"></td>';
                html += '<td><input type="text" name="contacts[' + contact_flag + '][position]" class="form-control"></td>';
                html += '<td><input type="text" name="contacts[' + contact_flag + '][phone_number]" class="form-control"></td>';
                html += '</tr>';

                $('#contacts_table>tbody').append(html);

                $.contextMenu({
                    selector: '.contact_tr',
                    items: {
                        'delete': {
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