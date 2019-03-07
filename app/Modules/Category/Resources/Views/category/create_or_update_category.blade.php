@extends('layouts.layer')
@section('content')
    <div class="box-body">
        <div class="col-xs-10 col-xs-offset-1">
            <form class="form-horizontal">
                <input type="hidden" name="action" value="{{$action or 'create'}}">
                <input type="hidden" name="type" value="{{$type or 'product'}}">
                <input type="hidden" name="parent_id" value="{{$parent_id or 0}}">
                @if('update' == $action)
                    <input type="hidden" name="category_id" value="{{$category_id}}">
                @endif
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('category::category.category_name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="name" class="form-control" value="{{$category_info->name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('category::category.display_name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="display_name" class="form-control" value="{{$category_info->display_name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">@lang('application.description')</label>
                    <div class="col-xs-10">
                        <textarea name="description" class="form-control" rows="4">{{$category_info->description or ''}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection