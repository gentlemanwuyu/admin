@extends('layouts.template')
@section('title')Login | {{$project_name}}@endsection
@section('css')
    <style>
        body { background: #d2d6de; }
    </style>
@endsection
@section('body_content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Gentleman</b>Admin</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            @include('errors.show')
            <form action="{{route('sign_in')}}" method="post">
                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="{{trans('auth::auth.email')}}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="{{trans('auth::auth.password')}}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="text" class="form-control" name="captcha" required oninvalid="setCustomValidity('请输入验证码')" oninput="setCustomValidity('');">
                        </div>
                        <div class="col-xs-4">
                            <img src="{{Captcha::src('gentleman')}}" alt="captcha" onclick="this.src='{{Captcha::src('gentleman')}}?'+Math.random()">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" class="minimal" name="remember">&nbsp;&nbsp;{{trans('auth::auth.remember_me')}}
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{trans('auth::auth.sign_in')}}</button>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection