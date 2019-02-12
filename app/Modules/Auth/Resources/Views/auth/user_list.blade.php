@extends('layouts.default')
@section('title')
    {{trans('template.user_list')}} | {{$project_name}}
@endsection
@section('content')
    <section class="content-header">
        <h1>@lang('template.user_list')</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i>@lang('template.auth_management')</a></li>
            <li class="active">@lang('template.user_list')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-xs-6">
                    <div class="btn-group">
                        <button id="add_user" type="button" class="btn btn-primary" title="{{trans('auth::auth.add_user')}}"><i class="fa fa-user-plus"></i></button>
                    </div>
                </div>
                <div class="col-xs-2 pull-right">
                    <form>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control pull-right" value="{{$search or ''}}" placeholder="{{trans('application.search')}}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>@lang('application.index_number')</th>
                        <th>@lang('auth::auth.user_name')</th>
                        <th>@lang('auth::auth.email')</th>
                        <th>@lang('auth::auth.telephone')</th>
                        <th>@lang('auth::auth.gender')</th>
                        <th>@lang('application.created_at')</th>
                        <th>@lang('application.action')</th>
                    </thead>
                    <?php
                        if (!isset($page) || $page <= 0) {
                            $page = 1;
                        }
                        $page_size = $users->perPage() ?: 0;
                        $i = ($page - 1) * $page_size + 1;
                    ?>
                    @foreach($users as $user)
                        <tr data-id="{{$user->id}}">
                            <td>{{$i++}}</td>
                            <td>{{$user->name or ''}}</td>
                            <td>{{$user->email or ''}}</td>
                            <td>{{$user->telephone or ''}}</td>
                            <td>{{trans('auth::auth.'.$user->gender)}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <a href="javascript:;">
                                    <i class="fa fa-edit edit_user" title="{{trans('auth::auth.edit_user')}}"></i>
                                </a>
                                <a href="javascript:;">
                                    <i class="fa fa-trash delete_user" title="{{trans('auth::auth.delete_user')}}"></i>
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
@section('scripts')
    <script>
        $(function () {
            // 添加用户
            $('#add_user').on('click', function () {
               layer.open({
                   type: 2,
                   area: ['50%', '60%'],
                   fix: false,
                   skin: 'layui-layer-rim',
                   maxmin: true,
                   shade: 0.5,
                   anim: 4,
                   title: "{{trans('auth::auth.add_user')}}",
                   btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                   yes: function (index) {
                       var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                       var load_index = layer.load();
                       $.ajax({
                           method: "post",
                           url: "{{route('auth::auth.create_or_update_user')}}",
                           data: data,
                           success: function (data) {
                               layer.close(load_index);
                               if ('success' == data.status) {
                                   layer.close(index);
                                   layer.msg("{{trans('auth::auth.user_create_or_update_successful')}}", {icon:1});
                                   parent.location.reload();
                               } else {
                                   layer.msg("{{trans('auth::auth.user_create_or_update_fail')}}:"+data.msg, {icon:2});
                                   return false;
                               }
                           },
                           error: function (XMLHttpRequest, textStatus, errorThrown) {
                               layer.close(load_index);
                               layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                               return false;
                           }
                       });
                   },
                   content: "{{route('auth::auth.create_or_update_user_page')}}?action=create"
               });
            });

            // 修改用户
            $('.edit_user').on('click', function () {
                var user_id = $(this).parents('tr').attr('data-id');
                layer.open({
                    type: 2,
                    area: ['50%', '60%'],
                    fix: false,
                    skin: 'layui-layer-rim',
                    maxmin: true,
                    shade: 0.5,
                    anim: 4,
                    title: "{{trans('auth::auth.edit_user')}}",
                    btn: ['{{trans('application.confirm')}}', '{{trans('application.cancel')}}'],
                    yes: function (index) {
                        var data = $(layer.getChildFrame('body',index)).find('form').serialize();
                        var load_index = layer.load();
                        $.ajax({
                            method: "post",
                            url: "{{route('auth::auth.create_or_update_user')}}",
                            data: data,
                            success: function (data) {
                                layer.close(load_index);
                                if ('success' == data.status) {
                                    layer.close(index);
                                    layer.msg("{{trans('auth::auth.user_create_or_update_successful')}}", {icon:1});
                                    parent.location.reload();
                                } else {
                                    layer.msg("{{trans('auth::auth.user_create_or_update_fail')}}:"+data.msg, {icon:2});
                                    return false;
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                layer.close(load_index);
                                layer.msg(packageValidatorResponseText(XMLHttpRequest.responseText), {icon:2});
                                return false;
                            }
                        });
                    },
                    content: "{{route('auth::auth.create_or_update_user_page')}}?action=update&user_id=" + user_id
                });
            });

            // 删除用户
            $('.delete_user').on('click', function () {
                var user_id = $(this).parents('tr').attr('data-id');
                layer.confirm("{{trans('auth::auth.user_delete_confirm')}}", {icon: 3, title:"{{trans('application.confirm')}}"}, function (index) {
                    layer.close(index);
                    var load_index = layer.load();
                    $.ajax({
                        method: "post",
                        url: "{{route('auth::auth.delete_user')}}",
                        data: {user_id: user_id},
                        success: function (data) {
                            layer.close(load_index);
                            if ('success' == data.status) {
                                layer.msg("{{trans('auth::auth.user_delete_successful')}}", {icon:1});
                                parent.location.reload();
                            } else {
                                layer.msg("{{trans('auth::auth.user_delete_fail')}}"+data.msg, {icon:2});
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
        });
    </script>    
@endsection