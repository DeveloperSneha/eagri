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
                        <span id="spnpermits" class="digital f-b">2</span>
                    </div>

                </li>
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-3 txt-cnt fl">

                        <span id="Master_lbl_second" class="digital" style="font-size:Small;">App. Schemes</span><br>
                        <span id="spntransitforms" class="digital f-b">1</span>
                    </div>
                </li>
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-1 txt-cnt fl">
                        <span id="Master_lbl_third" class="digital" style="font-size:Small;">Rej. Schemes</span><br>
                        <span id="spnstationery" class="digital f-b">0</span>

                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;@auth {{ Auth::user()->userName }} @endauth<span class="caret"></span>
                        <!--@auth <p>{{ Auth::user()->userName }}</p> @endauth-->
                    </a>

                    <ul class="dropdown-menu">
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
                <a href="{{ url('/authority')}}">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ checkActive(['authority/profile']) }}">
                    <a href="{{ url('/authority/profile')}}">
                        <span>Profile</span>
                    </a>
            </li>
            @can('add-user')
            <li class=" {{ checkActive(['authority/adduser','authority/adduser/*/edit']) }}">
                <a href="{{ url('/authority/adduser')}}">
                    <span>Add User</span>
                </a>
            </li>
            @endcan
            
            <li class="treeview {{ checkActive(['authority/schemes','authority/schemes/*','authority/approvedscheme','authority/rejectedscheme','authority/blockwisescheme'])}}">
                <a href="#">
                    <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/schemes']) }}"><a href="{{ url('/authority/schemes')}}">Scheme For Approval</a></li>
                    <li class="{{ checkActive(['authority/approvedscheme']) }}"><a href="{{ url('/authority/approvedscheme')}}">Approved Scheme</a></li>
                    <li class="{{ checkActive(['authority/rejectedscheme']) }}"><a href="{{ url('/authority/rejectedscheme')}}">Rejected Scheme</a></li>
                    <li class="{{ checkActive(['authority/blockwisescheme']) }}"><a href="{{ url('/authority/blockwisescheme') }}">Scheme Distribution Block</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <span>Vendor management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['/']) }}"><a href="#">Registered Vendor</a></li>
                    <li class="{{ checkActive(['/']) }}"><a href="#">Cancel Vendor Registration</a></li>
                    <li class="{{ checkActive(['/']) }}"><a href="#">Blacklisted Vendor</a></li>
                </ul>
            </li>
            <li class="treeview {{ checkActive(['authority/registeredfarmer','authority/cancelregfarmer','authority/blacklistedfarmer'])}}">
                <a href="#">
                    <span>Farmer Section</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/registeredfarmer']) }}"><a href="{{ url('/authority/registeredfarmer')}}">Registered Farmer</a></li>
<!--                    <li class="{{ checkActive(['authority/cancelregfarmer']) }}"><a href="{{ url('/authority/cancelregfarmer')}}">Cancel Farmer Registration</a></li>-->
                    <li class="{{ checkActive(['authority/blacklistedfarmer']) }}"><a href="{{ url('/authority/blacklistedfarmer')}}">Blacklisted Farmer</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <span>Reports</span>
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