@extends('layouts.template')
@section('css')
    <style>

    </style>
@endsection
@section('body')
    <form class="form-horizontal">
        <input type="hidden" name="customer_id" value="{{$customer_id or 0}}">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border"></div>
                <div class="box-body">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">@lang('customer::customer.customer_manager')</label>
                            <div class="col-xs-9">
                                <select name="manager_id" class="form-control select2">
                                    <option value="">@lang('customer::customer.please_select_customer_manager')</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection