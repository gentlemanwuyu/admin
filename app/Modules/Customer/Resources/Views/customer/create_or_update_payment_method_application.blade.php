@extends('layouts.template')
@section('css')
    <style>
        .payment_method_div>label:not(:first-child) {
            margin-left: 25px!important;
        }
    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <input type="hidden" name="action" value="{{$action or 'create'}}">
        <input type="hidden" name="application_id" value="{{$application_id or 0}}">
        <input type="hidden" name="customer_id" value="{{$customer_id or 0}}">
        <div class="box box-primary">
            <div class="box-header with-border"></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="col-xs-3 control-label required">@lang('customer::customer.payment_method')</label>
                            <div class="col-xs-9 payment_method_div" style="padding-top: 7px;">
                                <?php
                                    $methods = Payment::$methods;
                                    $init_method_id = 1;
                                    $init_limit_amount = '';
                                    $init_monthly_day = '';
                                    if ('create' == $action) {
                                        if (!empty($customer_info->paymentMethod)) {
                                            $init_method_id = $customer_info->paymentMethod->method_id;
                                            $init_limit_amount = $customer_info->paymentMethod->limit_amount;
                                            $init_monthly_day = $customer_info->paymentMethod->monthly_day;
                                        }
                                    }elseif ('update' == $action) {
                                        $init_method_id = $application_info->method_id;
                                        $init_limit_amount = $application_info->limit_amount;
                                        $init_monthly_day = $application_info->monthly_day;
                                        unset($methods[1]);
                                    }
                                ?>
                                @foreach($methods as $method_id => $method_name)
                                    <label style="margin: 0;">
                                        <input type="radio" class="minimal" name="payment_method_id" value="{{$method_id}}" @if($init_method_id == $method_id) checked @endif>
                                        &nbsp;&nbsp;@lang('application.' . $method_name)
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div id="limit_amount_div" class="form-group" @if(2 != $init_method_id) style="display: none;" @endif>
                            <label class="col-xs-3 control-label required">@lang('customer::customer.limit_amount')</label>
                            <div class="col-xs-9 payment_method_div">
                                <div class="input-group">
                                    <span class="input-group-addon">￥</span>
                                    <input type="text" class="form-control" name="limit_amount" oninput="value=value.replace(/[^\d]/g, '')" @if(2 == $init_method_id) value="{{$init_limit_amount or ''}}" @endif>
                                </div>
                            </div>
                        </div>
                        <div id="monthly_day_div" class="form-group" @if(3 != $init_method_id) style="display: none;" @endif>
                            <label class="col-xs-3 control-label required">@lang('customer::customer.monthly_day')</label>
                            <div class="col-xs-9 payment_method_div">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="monthly_day" oninput="value=value.replace(/[^\d]/g, '')" @if(3 == $init_method_id) value="{{$init_monthly_day or ''}}" @endif>
                                    <span class="input-group-addon">@lang('application.day')</span>
                                </div>
                            </div>
                        </div>
                        <div id="apply_reason_div" class="form-group" @if(1 == $init_method_id) style="display: none;" @endif>
                            <label class="col-xs-3 control-label required">@lang('customer::customer.apply_reason')</label>
                            <div class="col-xs-9">
                                <textarea class="form-control" name="apply_reason" rows="4">@if(isset($application_info)){{$application_info->message}}@endif</textarea>
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
        $(function () {
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