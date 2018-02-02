<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper">
            <header class="main-header navbar navbar-fixed-top head-top">
                <!-- Logo -->
                <a href="{{ url('/authority')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Agri</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Agriculture Department <br>Haryana</b></span>
                    <!--<img src="{{asset('dist/img/logo.png') }}" alt="User Image" height="45" width="200">-->
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <div class="parallelogram bg-1 txt-cnt fl">
                                    <span id="Master_lbl_first" class="digital" style="font-size:Small;">Reg. Farmers</span><br>
                                    <span id="spnpermits" class="digital f-b">
                                        {{$users = DB::table('farmers')->where('idBlock','=',Session::get('idBlock'))->distinct('idFarmer')->get()->count()}}
                                    </span>
                                </div>

                            </li>
                            <li class="dropdown notifications-menu">
                                <div class="parallelogram bg-3 txt-cnt fl">

                                    <span id="Master_lbl_second" class="digital" style="font-size:Small;">App. Schemes</span><br>
                                    <span id="spntransitforms" class="digital f-b">
                                        {{ $app_program = DB::table('schemeappreject')
                                                    ->where('idDesignation','=',Session::get('idDesignation'))
                                                    ->where('status','=','A')
                                                    ->get()->count()
                                        }}
                                    </span>
                                </div>
                            </li>
                            <li class="dropdown notifications-menu">
                                <div class="parallelogram bg-1 txt-cnt fl">
                                    <span id="Master_lbl_third" class="digital" style="font-size:Small;">Rej. Schemes</span><br>
                                    <span id="spnstationery" class="digital f-b">
                                        {{ $rej_program = DB::table('schemeappreject')
                                                    ->where('idDesignation','=',Session::get('idDesignation'))
                                                    ->where('status','=','R')
                                                    ->get()->count()
                                        }}
                                    </span>

                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user"></i>&nbsp;&nbsp;@auth {{ Auth::user()->userName }} @endauth<span class="caret"></span>
                                    <!--@auth <p>{{ Auth::user()->userName }}</p> @endauth-->
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{url('/authority/villages/updtpwd')}}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Password</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('authority.logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('authority.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                   
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <center><div id="google_translate_element"  class="sidebar-form"></div></center>

                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="">

                        </li>
                    </ul>
                </section>
            </aside>
            @include('authority.villages.sidebar')
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
                    <ul class="alert alert-warning">
                        {{ session()->get('message') }}
                    </ul>
                    @endif
                    @include('flash::message')
                    {{--    @if ($errors->any())
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
    <div id="feedback" style="z-index: 100000;" >
        <div id="feedback-form" style='display: none;background-color:white;' class="col-xs-4 col-md-4 p-10">
            <div style='background-color:aqua;'>
                <div class="w-100 fl p-5 f-b f-14 txt-cnt m-b-20" style="background-color:rgba(252,139,28,0.9); color:#fff;padding: 8px;">
                    HELP DESK
                </div>

                <div class="w-100 fl f-b p-5 m-l-10 f-12" style="margin: 10px 10px;">hkcl.co.in</div>
            </div>
        </div>
        <div id="feedback-tab">Helpdesk</div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.02.01.01
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
