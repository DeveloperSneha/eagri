<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper">
           
            @include('layouts.partials.nav')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
<!--                <section class="content-header">
                    <h1>
                        Dashboard <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>-->

                <!-- Main content -->
                <section class="content">
               {{--     @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif --}}
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
<!--                <div class="pull-right hidden-xs">

                </div>-->
<center>
                <strong>Copyright &copy; 2017 <a href="https://hkcl.co.in">HKCL</a>.</strong> All rights
                reserved.
</center>
            </footer>

        </div>
        <!-- ./wrapper -->
        @include('layouts.partials.script')
        @yield('script')
    </body>
</html>
