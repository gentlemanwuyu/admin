@extends('layouts.default')
@section('title')
    @lang('supplier::supplier.supplier_detail') | {{$project_name}}
@endsection
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('supplier::supplier.supplier_detail')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cubes"></i>@lang('template.supplier_management')</a></li>
            <li class="active">@lang('supplier::supplier.supplier_detail')</li>
        </ol>
    </section>
    <section class="content">
        <form class="form-horizontal">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('application.base_info')</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.name')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('supplier::supplier.supplier_code')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->code or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.company')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->company or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.phone')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->phone_number or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.fax')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->fax or ''}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.country')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->country->zh_name}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.address')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->full_address or ''}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">@lang('application.introduction')</label>
                                <div class="col-xs-9">
                                    <span class="form-control-span">{{$supplier_info->introduction or ''}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">@lang('application.contact')</div>
                        <div class="panel-body">
                            <table class="table" style="margin-bottom: 0;">
                                <thead>
                                <th>@lang('application.name')</th>
                                <th>@lang('application.position')</th>
                                <th>@lang('application.phone')</th>
                                </thead>
                                <tbody>
                                @foreach($supplier_info->contacts as $contact)
                                    <tr>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->position}}</td>
                                        <td>{{$contact->phone_number}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">@lang('application.log')</div>
                        <div class="panel-body" style="max-height: 400px;overflow: auto;">
                            <table class="table" style="margin-bottom: 0;">
                                <thead>
                                <th style="width: 10%;">@lang('application.action')</th>
                                <th style="width: 15%;">@lang('application.actor')</th>
                                <th style="text-align: left;">@lang('application.content')</th>
                                <th style="width: 20%;">@lang('application.time')</th>
                                </thead>
                                <tbody>
                                @foreach($supplier_info->logs as $log)
                                    <tr>
                                        <td>{{$log->action_name ? trans('application.' . $log->action_name) : ''}}</td>
                                        <td>{{$log->user->name}}</td>
                                        <td style="text-align: left;">
                                            @if(in_array($log->action, [1, 2]))
                                                <a href="javascript:;" class="view_detailed_content" data-flag="fold">
                                                    @lang('supplier::supplier.view_detailed_content')
                                                </a>
                                                <div class="content_div" style="word-break: break-all;word-wrap: break-word; border-top: 1px solid #f4f4f4; display: none;">
                                                    {!! $log->content !!}
                                                </div>
                                            @else
                                                {{$log->content}}
                                            @endif
                                        </td>
                                        <td>{{$log->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
           $('.view_detailed_content').on('click', function () {
               var flag = $(this).attr('data-flag');
               if ('fold' == flag) {
                   $('.view_detailed_content').attr('data-flag', 'fold');
                   $('.view_detailed_content').parents('td').find('.content_div').hide();
                   $('.view_detailed_content').parents('td').find('a').html("@lang('supplier::supplier.view_detailed_content')");
                   $(this).attr('data-flag', 'unfold');
                   $(this).html("@lang('application.fold')");
                   $(this).parents('td').find('.content_div').show();
               }else {
                   $(this).attr('data-flag', 'fold');
                   $(this).html("@lang('supplier::supplier.view_detailed_content')");
                   $(this).parents('td').find('.content_div').hide();
               }
           });
        });
    </script>
@endsection