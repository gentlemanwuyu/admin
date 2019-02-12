@extends('layouts.layer')
@section('content')
    <div class="box-body">
        <div class="col-xs-10 col-xs-offset-1">
            <form class="form-horizontal">
                <input type="hidden" name="action" value="{{$action or 'create'}}">
                @if('update' == $action)
                    <input type="hidden" name="permission_id" value="{{$permission_id}}">
                @endif
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('application.type')</label>
                    <div class="col-xs-10">
                        <select name="type_id" class="form-control">
                            <option value="">@lang('entrust::permission.please_select_permission_type')</option>
                            @foreach($permission_types as $type_id => $type)
                                <option value="{{$type_id}}" @if(isset($permission_info) && $type_id == $permission_info->type_id) selected @endif>{{trans('application.'.$type)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('entrust::permission.name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="name" class="form-control" value="{{$permission_info->name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('entrust::permission.display_name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="display_name" class="form-control" value="{{$permission_info->display_name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">@lang('application.description')</label>
                    <div class="col-xs-10">
                        <textarea name="description" rows="3" class="form-control">{{$permission_info->description or ''}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection