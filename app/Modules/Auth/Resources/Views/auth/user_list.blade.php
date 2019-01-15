@extends('layouts.default')
@section('title')
    {{trans('auth::auth.user_list')}} | {{$project_name}}
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('auth::auth.user_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('auth::auth.auth_management')</a></li>
            <li class="active">@lang('auth::auth.user_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-2 pull-right">
                    <div class="input-group input-group-sm">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" title="{{trans('auth::auth.add_user')}}"><i class="fa fa-user-plus"></i></button>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>@lang('auth::auth.no')</th>
                        <th>@lang('auth::auth.user_name')</th>
                        <th>@lang('auth::auth.email')</th>
                        <th>@lang('auth::auth.telephone')</th>
                        <th>@lang('auth::auth.gender')</th>
                        <th>@lang('auth::auth.created_at')</th>
                        <th>@lang('auth::auth.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $users->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->name or ''}}</td>
                            <td>{{$user->email or ''}}</td>
                            <td>{{$user->telephone or ''}}</td>
                            <td>{{trans('auth::auth.'.$user->gender)}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit" title="{{trans('auth::auth.edit_user')}}"></i>
                                </a>
                                <a href="javascript:;">
                                    <i class="fa fa-trash" title="{{trans('auth::auth.delete_user')}}"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{$users->links()}}
            </div>
        </div>
    </section>
@endsection