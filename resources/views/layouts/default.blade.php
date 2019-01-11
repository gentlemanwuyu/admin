@extends('layouts.template')
@section('body')
    <div class="wrapper">
        <!-- header -->
        @include('layouts.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')

        <!-- Control Sidebar -->
        @include('layouts.control_sidebar')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@endsection