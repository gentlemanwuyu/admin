@extends('layouts.layer')
@section('content')
    <div class="box-body">
        <div class="col-xs-10 col-xs-offset-1">
            <form class="form-horizontal">
                <input type="hidden" name="action" value="{{$action or 'create'}}">
                @if('update' == $action)
                    <input type="hidden" name="role_id" value="{{$role_id}}">
                @endif
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('entrust::role.name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="name" class="form-control" value="{{$role_info->name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('entrust::role.display_name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="display_name" class="form-control" value="{{$role_info->display_name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">@lang('application.description')</label>
                    <div class="col-xs-10">
                        <textarea name="description" rows="3" class="form-control">{{$role_info->description or ''}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <?php
                        if (isset($role_info)) {
                            $role_permission = array_column($role_info->perms->toArray(), 'id');
                        }
                    ?>
                    <label class="col-xs-2 control-label required">@lang('entrust::role.permission')</label>
                    <div class="col-xs-10">
                        <select name="permissions[]" class="form-control select2" multiple="multiple" data-placeholder="{{trans('entrust::role.please_select_permission')}}">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}" @if(isset($role_info) && in_array($permission->id, $role_permission)) selected @endif>{{$permission->display_name or ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection