<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link href="{{asset('/favicon.ico')}}" rel="shortcut icon" type="image/ico"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/morris.js/morris.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/plugins/iCheck/all.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('/assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- orgchart -->
    <link rel="stylesheet" href="{{asset('/assets/orgchart/dist/css/jquery.orgchart.min.css')}}">
    <!-- jquery-contextmenu -->
    <link rel="stylesheet" href="{{asset('/assets/jquery-contextmenu/dist/jquery.contextMenu.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- 自定义css样式 -->
    <link rel="stylesheet" href="{{asset('/assets/css/application.css')}}">
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
@yield('body')

<!-- jQuery 3 -->
<script src="{{asset('/assets/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('/assets/adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('/assets/adminlte/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/assets/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('/assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('/assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('/assets/adminlte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/assets/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/assets/adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/assets/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/assets/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('/assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- select2 -->
<script src="{{asset('/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('/assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/assets/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('/assets/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- layui -->
<script src="{{asset('assets/layui-src/dist/layui.all.js')}}"></script>
<!-- orgchart -->
<script src="{{asset('/assets/orgchart/dist/js/jquery.orgchart.min.js')}}"></script>
<!-- jquery-contextmenu -->
<script src="{{asset('/assets/jquery-contextmenu/dist/jquery.contextMenu.min.js')}}"></script>
<script src="{{asset('/assets/jquery-contextmenu/dist/jquery.ui.position.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/assets/js/application.js')}}"></script>
@yield('scripts')
</body>
</html>