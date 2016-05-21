<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $page_tile or "Hệ thống thống kê." }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ '/adminLTE/bootstrap/css/bootstrap.min.css' }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/morris/morris.css' }}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/datepicker/datepicker3.css' }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/daterangepicker/daterangepicker-bs3.css' }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' }}">


    <link rel="stylesheet" href="{{ '/adminLTE/plugins/datatables/dataTables.bootstrap.css' }}">
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/iCheck/all.css' }}">



    <!-- iCheck -->
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/iCheck/square/blue.css' }}">
    <link rel="stylesheet" href="{{ '/adminLTE/plugins/select2/select2.min.css' }}">

    <link rel="stylesheet" href="{{ '/adminLTE/dist/css/skins/skin-blue.min.css' }}">
    <link rel="stylesheet" href="{{ '/adminLTE/dist/css/skins/_all-skins.min.css' }}">

    <link rel="stylesheet" href="{{ '/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' }}">

    <link rel="stylesheet" href="{{ '/style.css' }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ '/adminLTE/dist/css/AdminLTE.min.css' }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    @include('admin/header');
    <!-- Left side column. contains the logo and sidebar -->
    @include('admin/sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               @yield('page-header')
                <small>@yield('optional-description')</small>
            </h1>
                @yield('breadcrumb')
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <!-- Main Footer -->
    @include('admin.footer')

            <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ '/adminLTE/plugins/jQuery/jQuery-2.1.4.min.js' }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ '/adminLTE/bootstrap/js/bootstrap.min.js' }}"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ '/adminLTE/plugins/morris/morris.min.js' }}"></script>

<!-- AdminLTE App -->
<script src="{{ '/adminLTE/dist/js/app.min.js' }}"></script>
<script src="{{ '/adminLTE/plugins/iCheck/icheck.min.js' }}"></script>
<script src="{{ '/adminLTE/plugins/select2/select2.full.min.js' }}"></script>
<!-- DataTables -->
<script src="{{ '/adminLTE/plugins/datatables/jquery.dataTables.min.js' }}"></script>
<script src="{{ '/adminLTE/plugins/datatables/dataTables.bootstrap.min.js' }}"></script>
<!-- SlimScroll -->
<script src="{{ '/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js' }}"></script>



<!-- Fastclick -->
<script src="{{ '/adminLTE/plugins/fastclick/fastclick.min.js' }}"></script>
{{--Chartjs--}}
<script src="{{ '/adminLTE/plugins/chartjs/Chart.min.js' }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>


<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        //Initialize Select2 Elements
        $(".select2").select2();

    });
    $(function () {
        $("#example1").DataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            searching: false,
            iDisplayLength: -1,
            ordering: true,
            order: [[0, 'desc']]
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

@stack('scripts')
</body>
</html>
