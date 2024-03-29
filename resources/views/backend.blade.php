<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>DCN - CMS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {!! HTML::style( asset('css/backend.css') ) !!}
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{URL::route('admin.dashboard')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>D</b>C</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>DCN</b> CMS</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            @include('backend._partials.messages-dropdown')
                        </li><!-- /.messages-menu -->

                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            @include('backend._partials.notifications-dropdown')
                        </li>
                        <!-- Tasks Menu -->
                        <li class="dropdown tasks-menu">
                            @include('backend._partials.tasks-dropdown')
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            @include('backend._partials.user-dropdown')
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    @include('backend._partials.user-panel')
                </div>
                <!-- /.Sidebar user panel -->

                <!-- search form (Optional) -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                    </div>
                </form>
                <!-- /.search form -->

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    @include('backend._partials.navigation')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title','Title')
                    <small>@yield('subtitle','Subtitle')</small>
                </h1>
                <ol class="breadcrumb">
                    @yield('breadcrumbs','<li><a href="#"><i class="fa fa-dashboard"></i> Bread</a></li><li class="active">Crumbs</li>')
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12" id="alert-area">
                        @include('backend._partials.errors')
                    </div>
                </div>
                @yield('content',"")
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                <!-- -->
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2015 <a href="/">DCN CMS</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            @include('backend._partials.control-sidebar')
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    {!! HTML::script( asset('js/backend.js') ) !!}
    @yield('javascript')
    <script>
        function errorJson(json)
        {
            $.each(json.responseJSON, function(key, value){
                var str = '@oneLine('backend._partials.jsonError')';
                $('#alert-area').append(str) ;
            });
        }
        $( document ).ready()
        {
            $('#alert-area').bind('DOMNodeInserted', function(event) {
                setTimeout(function() {
                    $(".autoClose").fadeOut(1000);
                },3000);

            });
        }

    </script>
</body>
</html>