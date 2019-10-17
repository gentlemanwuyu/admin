@extends('layouts.template')
@section('css')
    <style>
        div#street_address {
            margin-top: 10px;
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

                </div>
                <div class="box-footer clearfix no-border">
                    <button id="add_contact" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('customer::customer.add_contact')</button>
                </div>
            </div>
        </div>
    </form>
@endsection