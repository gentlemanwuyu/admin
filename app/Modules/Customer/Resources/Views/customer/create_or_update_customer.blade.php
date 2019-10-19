@extends('layouts.template')
@section('css')
    <style>
        div#street_address {
            margin-top: 10px;
        }
        .payment_method_div>label:not(:first-child) {
            margin-left: 25px!important;
        }
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
                    <input type="hidden" name="source" value="{{$source or ''}}">
                    <input type="hidden" name="parent_id" value="{{$parent_id or 0}}">
                    @if('update' == $action)
                        <input type="hidden" name="customer_id" value="{{$customer_id}}">
                    @endif
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('application.name')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="name" class="form-control" value="{{$customer_info->name or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('customer::customer.customer_code')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="code" class="form-control" value="{{$customer_info->code or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.company')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="company" class="form-control" value="{{$customer_info->company or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.phone')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="phone" class="form-control" value="{{$customer_info->phone_number or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.fax')</label>
                                <div class="col-xs-9">
                                    <input type="text" name="fax" class="form-control" value="{{$customer_info->fax or ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('application.country')</label>
                                <div class="col-xs-9">
                                    <select name="country_code" class="form-control select2">
                                        <option value="">@lang('customer::customer.please_select_country')</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country['abbreviation']}}" @if(isset($customer_info) && $customer_info->country_code == $country['abbreviation'] || !isset($customer_info) && 'CN' == $country['abbreviation']) selected @endif>
                                                {{$country['zh_name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.address')</label>
                                <div class="col-xs-9">
                                    <div id="chinese_address" class="row" @if(isset($customer_info) && 'CN' != $customer_info->country_code) style="display: none;" @endif>
                                        <div id="state" class="col-xs-4">
                                            <select name="state_id" class="form-control select2" style="width: 100%;">
                                                <option value="">@lang('customer::customer.please_select_state')</option>
                                                @foreach($chinese_regions as $region)
                                                    <option value="{{$region['id']}}" @if(isset($customer_info) && $customer_info->state_id == $region['id']) selected @endif>{{$region['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <?php
                                        $state_regions = [];
                                        if (isset($customer_info) && !empty($chinese_regions[$customer_info->state_id]['children'])) {
                                            $state_regions = $chinese_regions[$customer_info->state_id]['children'];
                                        }
                                        ?>
                                        <div id="city" class="col-xs-4" @if(!$state_regions) style="display: none;" @endif>
                                            <select name="city_id" class="form-control select2" style="width: 100%;">
                                                <option value="">@lang('customer::customer.please_select_city')</option>
                                                @foreach($state_regions as $region)
                                                    <option value="{{$region['id']}}" @if(isset($customer_info) && $customer_info->city_id == $region['id']) selected @endif>{{$region['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <?php
                                        $city_regions = [];
                                        if (isset($customer_info) && !empty($chinese_regions[$customer_info->state_id]['children'][$customer_info->city_id]['children'])) {
                                            $city_regions = $chinese_regions[$customer_info->state_id]['children'][$customer_info->city_id]['children'];
                                        }
                                        ?>
                                        <div id="county" class="col-xs-4" @if(!$city_regions) style="display: none;" @endif>
                                            <select name="county_id" class="form-control select2" style="width: 100%;">
                                                <option value="">@lang('customer::customer.please_select_county')</option>
                                                @foreach($city_regions as $region)
                                                    <option value="{{$region['id']}}" @if(isset($customer_info) && $customer_info->county_id == $region['id']) selected @endif>{{$region['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <?php
                                        $flag = false;
                                        if (isset($customer_info) && 'CN' == $customer_info->country_code) {
                                            if (!empty($chinese_regions[$customer_info->state_id])) {
                                                if (empty($chinese_regions[$customer_info->state_id]['children'])) {
                                                    $flag = true;
                                                }else {
                                                    if (!empty($chinese_regions[$customer_info->state_id]['children'][$customer_info->city_id])) {
                                                        if (empty($chinese_regions[$customer_info->state_id]['children'][$customer_info->city_id]['children'])) {
                                                            $flag = true;
                                                        }else {
                                                            if (!empty($chinese_regions[$customer_info->state_id]['children'][$customer_info->city_id]['children'][$customer_info->county_id])) {
                                                                $flag = true;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <div id="street_address" class="col-xs-12" @if(!$flag) style="display: none;" @endif>
                                            <input type="text" name="street_address" class="form-control" value="{{$customer_info->street_address or ''}}" placeholder="@lang('customer::customer.please_enter_street_address')">
                                        </div>
                                    </div>
                                    <div id="other_address" class="row" @if('create' == $action || isset($customer_info) && 'CN' == $customer_info->country_code) style="display: none;" @endif>
                                        <div class="col-xs-12">
                                            <input type="text" name="address" class="form-control" value="{{$customer_info->address or ''}}" placeholder="@lang('customer::customer.please_enter_detailed_address')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.introduction')</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="introduction" rows="4">{{$customer_info->introduction or ''}}</textarea>
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
                        <th>@lang('application.phone')</th>
                        </thead>
                        <tbody>
                        @if(isset($customer_info))
                            @foreach($customer_info->contacts as $contact)
                                <tr class="contact_tr" data-contact_flag="{{$contact->id}}">
                                    <td><input type="text" name="contacts[{{$contact->id}}][name]" class="form-control" value="{{$contact->name}}"></td>
                                    <td><input type="text" name="contacts[{{$contact->id}}][position]" class="form-control" value="{{$contact->position}}"></td>
                                    <td><input type="text" name="contacts[{{$contact->id}}][phone_number]" class="form-control" value="{{$contact->phone_number}}"></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix no-border">
                    <button id="add_contact" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('customer::customer.add_contact')</button>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h5 class="box-title">@lang('customer::customer.payment_method')</h5>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="col-xs-3 control-label required">@lang('customer::customer.payment_method')</label>
                                <div class="col-xs-9 payment_method_div" style="padding-top: 7px;">
                                    @foreach(Payment::$methods as $method_id => $method_name)
                                        <label style="margin: 0;">
                                            <input type="radio" class="minimal" name="payment_method_id" value="{{$method_id}}">
                                            &nbsp;&nbsp;@lang('application.' . $method_name)
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div id="limit_amount_div" class="form-group" style="display: none;">
                                <label class="col-xs-3 control-label required">@lang('customer::customer.limit_amount')</label>
                                <div class="col-xs-9 payment_method_div">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span>
                                        <input type="text" class="form-control" name="limit_amount">
                                    </div>
                                </div>
                            </div>
                            <div id="monthly_day_div" class="form-group" style="display: none;">
                                <label class="col-xs-3 control-label required">@lang('customer::customer.monthly_day')</label>
                                <div class="col-xs-9 payment_method_div">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="limit_amount">
                                        <span class="input-group-addon">@lang('application.day')</span>
                                    </div>
                                </div>
                            </div>
                            <div id="apply_reason_div" class="form-group" style="display: none;">
                                <label class="col-xs-3 control-label required">@lang('customer::customer.apply_reason')</label>
                                <div class="col-xs-9">
                                    <textarea class="form-control" name="apply_reason" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        html += '<option value="">@lang('customer::customer.please_select_city')</option>';
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
                        html += '<option value="">@lang('customer::customer.please_select_county')</option>';
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

            // 绑定右键事件
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

            $('input[name=payment_method_id]').on('ifChecked', function () {
                if (1 == this.value) {
                    $('input[name=limit_amount]').val('');
                    $('#limit_amount_div').hide();
                    $('input[name=monthly_day]').val('');
                    $('#monthly_day_div').hide();
                    $('textarea[name=apply_reason]').val('');
                    $('#apply_reason_div').hide();
                }else if (2 == this.value) {
                    $('#limit_amount_div').show();
                    $('#apply_reason_div').show();
                    $('input[name=monthly_day]').val('');
                    $('#monthly_day_div').hide();
                }else if (3 == this.value) {
                    $('#monthly_day_div').show();
                    $('#apply_reason_div').show();
                    $('input[name=limit_amount]').val('');
                    $('#limit_amount_div').hide();
                }
            });
        });
    </script>
@endsection