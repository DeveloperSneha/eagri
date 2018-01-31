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
                            {{$users = DB::table('farmers')->distinct('idFarmer')->get()->count()}}
                        </span>
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
               
            </li>
        </ul>
    </section>
</aside>
