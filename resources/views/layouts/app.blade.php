<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body class="hold-transition skin-green-light sidebar-mini" >
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
                    @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                    @endif
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
    <div id="feedback" style="z-index: 100000;" >
        <div id="feedback-form" style='display: none;background-color:white;' class="col-xs-4 col-md-4 p-10">
            <div style='background-color:aqua;'>
                <div class="w-100 fl p-5 f-b f-14 txt-cnt m-b-20" style="background-color:#9acd32; color:#fff;padding: 8px;">
                    HELP DESK
                </div>
                
                <div class="w-100 fl f-b p-5 m-l-10 f-12" style="margin: 10px 10px;">hkcl.co.in</div>
            </div>
        </div>
        <div id="feedback-tab">Helpdesk</div>
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
<!--    <center>-->
        <strong>Copyright &copy; 2018 <a href="https://hkcl.in">HKCL</a>.</strong> All Rights Reserved.
<!--    </center>-->
    </footer>

</div>
<!-- ./wrapper -->
@include('layouts.partials.script')
@yield('script')
</body>
</html>
