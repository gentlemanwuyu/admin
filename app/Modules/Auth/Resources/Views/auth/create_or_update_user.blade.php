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
                            <input type="radio" name="gender_id" class="minimal" value="1" @if(isset($user_info) && 1 == $user_info->gender_id) checked @endif>&nbsp;&nbsp;@lang('auth::auth.male')
                        </label>
                        <label style="margin-left: 20px;">
                            <input type="radio" name="gender_id" class="minimal" value="2" @if(isset($user_info) && 2 == $user_info->gender_id) checked @endif>&nbsp;&nbsp;@lang('auth::auth.female')
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label required">@lang('auth::auth.telephone')</label>
                    <div class="col-xs-10">
                        <input type="text" name="telephone" class="form-control telephone-mask" value="{{$user_info->telephone or ''}}">
                    </div>
                </div>
                <div class="form-group"
                     @if(isset($user_info) && 1 == $user_info->is_admin)
                        style="display: none;"
                     @endif
                >
                    <label class="col-xs-2 control-label required">@lang('auth::auth.department')</label>
                    <div class="col-xs-8">
                        <select name="department_id" class="form-control select2">
                            <option value="">@lang('auth::auth.please_select_department')</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}" @if(isset($user_info) && $department->id == $user_info->department_id) selected @endif>{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-2"
                         @if(!isset($user_info) || !$user_info->department_id)
                            style="display: none;"
                         @endif
                    >
                        <label style="margin-top: 7px;">
                            <input type="checkbox" class="minimal" name="is_leader" value="1" @if(isset($user_info) && 1 == $user_info->is_leader) checked @endif>&nbsp;&nbsp;@lang('auth::auth.is_leader')
                        </label>
                    </div>
                </div>
                @if(Auth::user()->is_admin)
                    <div class="form-group"
                         @if(isset($user_info) && $user_info->department_id)
                            style="display: none;"
                         @endif
                    >
                        <label class="col-xs-2 control-label">@lang('auth::auth.is_admin')</label>
                        <div class="col-xs-10">
                            <label>
                                <input type="radio" name="is_admin" class="minimal" value="1" @if(isset($user_info) && 1 == $user_info->is_admin) checked @endif>&nbsp;&nbsp;@lang('application.yes')
                            </label>
                            <label style="margin-left: 20px;">
                                <input type="radio" name="is_admin" class="minimal" value="0" @if('create' == $action || isset($user_info) && 0 == $user_info->is_admin) checked @endif>&nbsp;&nbsp;@lang('application.no')
                            </label>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-xs-2 control-label">@lang('auth::auth.role')</label>
                    <div class="col-xs-10">
                        <?php
                            if (isset($user_info)) {
                                $user_role = array_column($user_info->roles->toArray(), 'id');
                            }
                        ?>
                        <select name="roles[]" class="form-control select2" multiple="multiple" data-placeholder="{{trans('auth::auth.please_select_role')}}">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @if(isset($user_info) && in_array($role->id, $user_role)) selected @endif>{{$role->display_name or ''}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            // 部门/是否管理员二选一
            var is_admin = "{{Auth::user()->is_admin}}";
            $('select[name=department_id]').on('change', function () {
                if (this.value) {
                    $('input:checkbox[name=is_leader]').parents('div.col-xs-2').show();
                    if ('1' == is_admin) {
                        $('input[name=is_admin]').parents('div.form-group').hide();
                    }
                }else {
                    $('input:checkbox[name=is_leader]').parents('div.col-xs-2').hide();
                    if ('1' == is_admin) {
                        $('input[name=is_admin]').parents('div.form-group').show();
                    }
                }
            });

            if ('1' == is_admin) {
                $('input:radio[name=is_admin]').on('ifChecked', function () {
                    if ('0' == this.value) {
                        $('select[name=department_id]').parents('div.form-group').show();
                    }else {
                        $('select[name=department_id]').parents('div.form-group').hide();
                    }
                });
            }
        });
    </script>
@endsection