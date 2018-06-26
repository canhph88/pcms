<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/ic_favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IMS') }} - @yield('header_title', '')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/Ionicons/css/ionicons.min.css') }}">
    <!-- glyphicons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/glyphicons/glyphicon.css') }}">
    <!-- weather weather -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/weather-icons/weather-icons.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- date picker -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_plugins/iCheck/all.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">
    <!-- gallery -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor_components/gallery/css/animated-masonry-gallery.css') }}" />
    <!-- fancybox -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor_components/lightbox-master/dist/ekko-lightbox.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/master_style.css') }}?v=5">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/datatables.net-bs/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/jquery-ui-1.12.1/jquery-ui.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.min.css') }}">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    @yield('additional_head', '')
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt2MqN7ksuJFtirNzxqOWR0rGK8VQRCD4"></script>
    {{--<script src="{{ asset('js/jquery.validate.min.js') }}"></script>--}}
    <script src="{{ asset('js/common.js') }}?v=1"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"></script>--}}
    <style>
        @font-face{
            font-family:Font Awesome\ 5 Brands;
            font-style:normal;
            font-weight:400;
            src:url('{!! asset('fonts/fa-brands-400.eot') !!}');
            src:url('{!! asset('fonts/fa-brands-400.eot?#iefix') !!}') format("embedded-opentype"),url('{!! asset('fonts/fa-brands-400.woff2') !!}') format("woff2"),url('{!! asset('fonts/fa-brands-400.woff') !!}') format("woff"),url('{!! asset('fonts/fa-brands-400.ttf') !!}') format("truetype"),url('{!! asset('fonts/fa-brands-400.svg#fontawesome') !!}') format("svg")
        }
        .fab{font-family:Font Awesome\ 5 Brands}
        @font-face{
            font-family:Font Awesome\ 5 Free;
            font-style:normal;
            font-weight:400;
            src:url('{!! asset('fonts/fa-regular-400.eot') !!}');
            src:url('{!! asset('fonts/fa-regular-400.eot?#iefix') !!}') format("embedded-opentype"),url('{!! asset('fonts/fa-regular-400.woff2') !!}') format("woff2"),url('{!! asset('fonts/fa-regular-400.woff') !!}') format("woff"),url('{!! asset('fonts/fa-regular-400.ttf') !!}') format("truetype"),url('{!! asset('fonts/fa-regular-400.svg#fontawesome') !!}') format("svg")
        }
        .far{font-weight:400}
        @font-face{
            font-family:Font Awesome\ 5 Free;
            font-style:normal;
            font-weight:900;
            src:url('{!! asset('fonts/fa-solid-900.eot') !!}');
            src:url('{!! asset('fonts/fa-solid-900.eot?#iefix') !!}') format("embedded-opentype"),url('{!! asset('fonts/fa-solid-900.woff2') !!}') format("woff2"),url('{!! asset('fonts/fa-solid-900.woff') !!}') format("woff"),url('{!! asset('fonts/fa-solid-900.ttf') !!}') format("truetype"),url('{!! asset('fonts/fa-solid-900.svg#fontawesome') !!}') format("svg")
        }
        .fa,.fas{font-weight:900}
        .box-header {
            background: #BDBDBD;
        }
        .box-title {
            color: #fff;
        }
        .required:after {
            content: "*";
            color: red;
        }
        table.dataTable thead .sorting_disabled {
            background: transparent !important;
        }
        /* DATATABLES */
        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc,
        table.dataTable thead .sorting_asc_disabled,
        table.dataTable thead .sorting_desc_disabled {
            background: transparent;
        }
        .dataTables_wrapper {
            padding-bottom: 30px;
        }
        .dataTables_length {
            float: left;
        }
        .dataTables_filter label {
            margin-right: 0px;
        }

        .sidebar-collapse .sidebar-toggle:before{
            content: "\f0c9";
        }

        .pull-right {
            float: right;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed sidebar-collapse">
<div class="wrapper">

    @include('layouts.header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 620px !important;">
        @yield('content')
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="copyright">A product of <a href="javascript:void(0)">TECHATRIUM INNOVATION PTE LTD</a>. Copyright &copy; 2018. All rights reserved.</div>
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
{{--<script src="{{ asset('assets/vendor_components/jquery-ui/jquery-ui.js') }}"></script>--}}

<!-- jQuery UI 1.12.1 -->
<script src="{{ asset('assets/vendor_components/jquery-ui-1.12.1/jquery-ui.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- popper -->
<script src="{{ asset('assets/vendor_components/popper/dist/popper.min.js') }}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/vendor_components/chart-js/chart.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>

<!-- jvectormap -->
<script src="{{ asset('assets/vendor_plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
<!-- bootstrap time picker -->
{{--<script src="{{ asset('assets/vendor_plugiicheckns/timepicker/bootstrap-timepicker.min.js') }}"></script>--}}
<!-- Slimscroll -->
<script src="{{ asset('assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/vendor_components/fastclick/lib/fastclick.js') }}"></script>

<!-- minimal_admin App -->
<script src="{{ asset('js/template.js') }}"></script>

<!-- minimal_admin for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>

<!-- weather for demo purposes -->
<script src="{{ asset('assets/vendor_plugins/weather-icons/WeatherIcon.js') }}"></script>

<!-- DataTables -->
{{--<script src="{{ asset('assets/vendor_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>--}}
<!-- This is data table -->
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/input.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/ex-js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/ex-js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/ex-js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js') }}"></script>
<!-- end - This `is for export functionality only -->
<!-- steps  -->
<script src="{{ asset('assets/vendor_components/jquery-steps-master/build/jquery.steps.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- validate  -->
<script src="{{ asset('assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js') }}"></script>

<!-- Sweet-Alert  -->
<script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script><!-- Sweet-Alert  -->
{{--<script src="{{ asset('assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>--}}
<!-- wizard  -->
<script src="{{ asset('js/pages/steps.js') }}"></script>
<!-- minimal_admin for Data Table -->
<script src="{{ asset('js/pages/data-table.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
<!-- gallery -->
<script type="text/javascript" src="{{ asset('assets/vendor_components/gallery/js/animated-masonry-gallery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor_components/gallery/js/jquery.isotope.min.js') }}"></script>

<!-- fancybox -->
<script type="text/javascript" src="{{ asset('assets/vendor_components/lightbox-master/dist/ekko-lightbox.js') }}"></script>
<!-- minimal_admin for advanced form element -->
<script src="{{ asset('js/pages/advanced-form-element.js') }}"></script>
<script src="{{ asset('js/pages/validation.js') }}"></script>
<script src="{{ asset('js/incidents.js') }}?v=2"></script>
<script>
    //This is base url for javascript call ajax
    var baseUrl ="<?php echo e(url('')); ?>";
</script>
@yield('additional_scripts', '')
<!--Loading Page-->
<div style="display: none;" id="loading-process" class="loading">Loading&#8230;</div>
<!-- End Loading Page -->
</body>
<script>
    // $( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
    //     alert("Session expired. You'll be take to the login page");
    //     location.href = "/login";
    // });

    if($(window).width() < 767) {
        $('body').removeClass('sidebar-collapse');
    }
</script>
</html>
