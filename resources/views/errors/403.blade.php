@extends('layouts.template')
@section('title')
    404 Not Found | {{$project_name}}
@endsection
@section('css')
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        footer {
            position: absolute;
            bottom: 0;
            text-align: center;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: rgba(68, 65, 66, 0);
        }
        .error404-wrap h3 {
            font-size: 60px;
            margin: 80px 0 40px;
        }
        .error404-wrap a {
            display: inline-block;
            margin: 25px 15px 50px;
            color: #333;
            text-decoration: underline;
        }
    </style>
@endsection
@section('body')
    <div class="container" style="text-align: center;margin-top: 50px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <div class="panel panel-default">
                    <div class="error404-wrap">
                        <h3>@lang('template.no_permission_visit')</h3>
                        <p>@lang('template.take_back_to_homepage.left')<strong class="second">3</strong>@lang('template.take_back_to_homepage.right')</p>
                        <p class="contact-txt">
                            @lang('template.contact_admin')<a href="mailto:492444775@qq.com">492444775@qq.com</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- 底部 copyright -->
    <footer>
        <div class="container">
            <strong>Copyright &copy; {{config('template.footer.start_year', '2018')}}-{{date('Y')}} <a href="http://www.gentlemanwuyu.top">Gentleman WuYu</a>.</strong> All rights
            reserved.
        </div>
    </footer>
@endsection
@section('scripts')
    <script>
        $(function () {
            window.setInterval(function () {
                var second = $('.second').html();
                if (second > 0) {
                    $('.second').html(second - 1);
                }else {
                    window.location = '/';
                }
            }, 1000);
        });
    </script>
@endsection