@extends('layouts.default')
@section('title')
    {{trans('auth::auth.modify_password')}} | {{$project_name}}
@endsection
@section('css')
    <style>
        form {
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('auth::auth.modify_password')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('auth::auth.auth_management')</a></li>
            <li class="active">@lang('auth::auth.modify_password')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                            <div class="form-group">
                                <label for="new_password" class="col-xs-2 control-label">@lang('auth::auth.new_password')</label>
                                <div class="col-xs-10">
                                    <input type="password" name="new_password" class="form-control" id="new_password"
                                        placeholder="{{trans('auth::auth.type_new_password')}}" required
                                        oninvalid="setCustomValidity('{{trans('auth::auth.type_new_password')}}')" oninput="setCustomValidity('')"
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="col-xs-2 control-label">@lang('auth::auth.confirm_password')</label>
                                <div class="col-xs-10">
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                        placeholder="{{trans('auth::auth.type_confirm_password')}}" required
                                        oninvalid="setCustomValidity('{{trans('auth::auth.type_confirm_password')}}')" oninput="setCustomValidity('')"
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-2 control-label"></label>
                                <div class="col-xs-10">
                                    <button type="button" id="submit" class="btn btn-info">@lang('auth::auth.confirm')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {
            // 表单提交前判断两次输入是否一致
            $('#submit').on('click', function () {
                var new_password = $(this).find('input[name=new_password]').val();
                var confirm_password = $(this).find('input[name=confirm_password]').val();
                if (new_password !== confirm_password) {
                    layer.msg("{{trans('auth::auth.twice_password_different')}}", {'icon': 2});
                    return false;
                }

                var load_index = layer.load();
                $.ajax({
                    method: "post",
                    url: "{{route('auth::auth.modify_password')}}",
                    data: $(this).parents('form').serialize(),
                    success: function (data) {
                        layer.close(load_index);
                        if ('success' == data.status) {
                            layer.msg("{{trans('auth::auth.password_modify_success')}}", {icon:1});
                            window.location.href = '/';
                        } else {
                            layer.msg("{{trans('auth::auth.password_modify_fail')}}:" + data.msg, {icon:2});
                            return false;
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        layer.close(load_index);
                        layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                        return false;
                    }
                });
            });

        });
    </script>
@endsection