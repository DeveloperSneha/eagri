<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/authority')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Agri</b></span>
        <!-- logo for regular state and mobile devices -->
        <img src="{{asset('dist/img/logo.png') }}" alt="User Image" height="45" width="200">
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
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dist/img/user.jpg') }}" class="user-image" alt="User Image">
                        @auth<span class="hidden-xs">{{ Auth::user()->userName }}</span>@endauth
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('dist/img/user.jpg') }}" class="img-circle" alt="User Image">

                            @auth <p>{{ Auth::user()->userName }}</p> @endauth
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/authority/profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('authority.logout') }}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('authority.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
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
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @auth <p>{{ Auth::user()->name }}</p> @endauth
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ url('/authority')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('/authority/profile')}}">
                    <i class="fa fa-user-circle"></i> <span>Profile</span>
                </a>
            </li>
<!--            <li class="">
                <a href="{{ url('/authority/adduser') }}">
                    <i class="fa fa-user"></i> <span>Add User</span>
                </a>
            </li>-->
            <li class="treeview {{ checkActive(['authority/schemes','authority/schemes/*','authority/approvedscheme','authority/rejectedscheme','authority/blockwisescheme'])}}">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/schemes']) }}"><a href="{{ url('/authority/schemes')}}"><i class="fa fa-circle-o"></i>Scheme For Approval</a></li>
                    <li class="{{ checkActive(['authority/approvedscheme']) }}"><a href="{{ url('/authority/approvedscheme')}}"><i class="fa fa-circle-o"></i>Approved Scheme</a></li>
                    <li class="{{ checkActive(['authority/rejectedscheme']) }}"><a href="{{ url('/authority/rejectedscheme')}}"><i class="fa fa-circle-o"></i>Rejected Scheme</a></li>
                    <li class="{{ checkActive(['authority/blockwisescheme']) }}"><a href="{{ url('/authority/blockwisescheme') }}"><i class="fa fa-circle-o"></i>Scheme Distribution Blockwise</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Vendor management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['/']) }}"><a href="#"><i class="fa fa-circle-o"></i>Registered Vendor</a></li>
                    <li class="{{ checkActive(['/']) }}"><a href="#"><i class="fa fa-circle-o"></i>Cancel Vendor Registration</a></li>
                    <li class="{{ checkActive(['/']) }}"><a href="#"><i class="fa fa-circle-o"></i>Blacklisted Vendor</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Farmer Section</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['/']) }}"><a href="#"><i class="fa fa-circle-o"></i>Registered Farmer</a></li>
                    <li class="{{ checkActive(['/']) }}"><a href="#"><i class="fa fa-circle-o"></i>Cancel Farmer Registration</a></li>
                    <li class="{{ checkActive(['/']) }}"><a href="#"><i class="fa fa-circle-o"></i>Blacklisted Farmer</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   
                </ul>
            </li>
         </ul>
    </section>
    <!-- /.sidebar -->
</aside>