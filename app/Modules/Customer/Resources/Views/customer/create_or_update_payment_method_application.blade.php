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
                                    unset($methods[1]);
                                ?>
                                @foreach($methods as $method_id => $method_name)
                                    <label style="margin: 0;">
                                        <input type="radio" class="minimal" name="payment_method_id" value="{{$method_id}}" @if(isset($application_info) && $application_info->method_id == $method_id) checked @endif>
                                        &nbsp;&nbsp;@lang('application.' . $method_name)
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div id="limit_amount_div" class="form-group"
                             @if(isset($application_info) && 2 != $application_info->method_id)
                                style="display: none;"
                             @endif
                        >
                            <label class="col-xs-3 control-label required">@lang('customer::customer.limit_amount')</label>
                            <div class="col-xs-9 payment_method_div">
                                <div class="input-group">
                                    <span class="input-group-addon">￥</span>
                                    <input type="text" class="form-control" name="limit_amount" oninput="value=value.replace(/[^\d]/g, '')"
                                        @if(isset($application_info) && 2 == $application_info->method_id)
                                            value="{{$application_info->limit_amount or ''}}"
                                        @endif
                                    >
                                </div>
                            </div>
                        </div>
                        <div id="monthly_day_div" class="form-group"
                             @if(isset($application_info) && 3 != $application_info->method_id)
                                style="display: none;"
                             @endif
                        >
                            <label class="col-xs-3 control-label required">@lang('customer::customer.monthly_day')</label>
                            <div class="col-xs-9 payment_method_div">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="monthly_day" oninput="value=value.replace(/[^\d]/g, '')"
                                        @if(isset($application_info) && 3 == $application_info->method_id)
                                            value="{{$application_info->monthly_day or ''}}"
                                        @endif
                                    >
                                    <span class="input-group-addon">@lang('application.day')</span>
                                </div>
                            </div>
                        </div>
                        <div id="apply_reason_div" class="form-group">
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
                if (2 == this.value) {
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