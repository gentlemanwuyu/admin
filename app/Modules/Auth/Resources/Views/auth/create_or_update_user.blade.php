@extends('layouts.layer')
@section('content')
    <div class="box-body">
        <div class="col-xs-10 col-xs-offset-1">
            <form class="form-horizontal">
                <input type="hidden" name="action" value="{{$action or 'create'}}">
                @if('update' == $action)
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                @endif
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('auth::auth.email')</label>
                    <div class="col-xs-10">
                        @if('create' == $action)
                            <input type="email" name="email" class="form-control">
                        @else
                            <span class="form-control-span">{{$user_info->email}}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('auth::auth.user_name')</label>
                    <div class="col-xs-10">
                        <input type="text" name="name" class="form-control" value="{{$user_info->name or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">@lang('auth::auth.birthday')</label>
                    <div class="col-xs-10">
                        <input type="text" name="birthday" class="form-control date-mask"  value="{{$user_info->birthday or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('auth::auth.gender')</label>
                    <div class="col-xs-10">
                        <label>
                            <input type="radio" name="gender" class="minimal" value="1" @if(isset($user_info) && 1 == $user_info->gender) checked @endif>&nbsp;&nbsp;@lang('auth::auth.male')
                        </label>
                        <label style="margin-left: 20px;">
                            <input type="radio" name="gender" class="minimal" value="2" @if(isset($user_info) && 2 == $user_info->gender) checked @endif>&nbsp;&nbsp;@lang('auth::auth.female')
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('auth::auth.telephone')</label>
                    <div class="col-xs-10">
                        <input type="text" name="telephone" class="form-control telephone-mask" value="{{$user_info->telephone or ''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">@lang('auth::auth.is_admin')</label>
                    <div class="col-xs-10">
                        <label>
                            <input type="radio" name="is_admin" class="minimal" value="1" @if(isset($user_info) && 1 == $user_info->is_admin) checked @endif>&nbsp;&nbsp;@lang('application.yes')
                        </label>
                        <label style="margin-left: 20px;">
                            <input type="radio" name="is_admin" class="minimal" value="0" @if(isset($user_info) && 0 == $user_info->is_admin) checked @endif>&nbsp;&nbsp;@lang('application.no')
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection