<!DOCTYPE HTML>
<HTML>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Admin Panel" />
    <meta name="author" content="aib" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>mypharma @yield('title')</title>
    <link rel="icon" href="{{{ asset('favicon.ico') }}}">
    


    {!! HTML::style('assets\dashboard\vendors\bower_components\morris.js\morris.css') !!}
    
    {!! HTML::style('assets/dashboard/vendors/bower_components/chartist/dist/chartist.min.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/select2/dist/css/select2.min.css')!!}

    {!! HTML::style('assets/dashboard/vendors/vectormap/jquery-jvectormap-2.0.2.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') !!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/jquery.steps/demo/css/jquery.steps.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/jquery-wizard.js/css/wizard.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/sweetalert/dist/sweetalert.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/multiselect/css/multi-select.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}

    <!--custom fonts-->
    {!! HTML::style('assets/dashboard/dist/css/font-awesome.min.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/fullcalendar/dist/fullcalendar.css')!!}


    <!-- //custom css -->
    {!! HTML::style('assets/dashboard/vendors/bower_components/FooTable/compiled/footable.bootstrap.min.css')!!}

    {!! HTML::style('assets/dashboard/vendors/bower_components/dropify/dist/css/dropify.min.css')!!}

    {!! HTML::style('assets/dashboard/dist/css/style.css')!!}


    <script type="text/javascript" src="{{ URL::to('assets/dashboard/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    

    

    
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <div class="wrapper">
        <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        @include('socialworker.partials.sidebar')

        @yield('contents')
        @include('flash::message')
        
        @include('socialworker.partials.footer')
    </div>
    @yield('js')
</body>
</html>

