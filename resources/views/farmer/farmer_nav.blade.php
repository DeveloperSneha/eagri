<header class="main-header navbar navbar-fixed-top head-top">
    <!-- Logo -->
    <a href="{{ url('/farmer')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Agri</b></span>
        <span class="logo-lg"><b>Agriculture Department <br>Haryana</b></span>
        <!-- logo for regular state and mobile devices -->
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
                        <span id="Master_lbl_first" class="digital" style="font-size:Small;">Avail. Schemes</span><br>
                        <!--Count--<span id="spnpermits" class="digital f-b">2</span>-->
						<span id="spnpermits" class="digital f-b">{{ $schemes = DB::table('schemedistributiondistrict')
                ->join('schemeactivation', 'schemedistributiondistrict.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                ->join('scheme', 'schemeactivation.idScheme', '=', 'scheme.idScheme')
                ->where('schemedistributiondistrict.idDistrict', '=', $farmer->idDistrict)
                ->get()->count()}}</span>
						<!--end count-->
                    </div>

                </li>
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-3 txt-cnt fl">

                        <span id="Master_lbl_second" class="digital" style="font-size:Small;">App. Schemes</span><br>
                        <!--count<span id="spntransitforms" class="digital f-b">1</span>-->
						<span id="spntransitforms" class="digital f-b">{{ $users = DB::table('farmerapplied_scheme')
                     ->select(DB::raw('count(idAppliedScheme) as Count'))
                     ->where('idFarmer','=',$farmer->idFarmer)
                     ->get()->count()}}</span>
						<!--end Count-->
                    </div>
                </li>
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-1 txt-cnt fl">
                        <span id="Master_lbl_third" class="digital" style="font-size:Small;">Rej. Schemes </span><br>
                        <span id="spnstationery" class="digital f-b">0</span>

                    </div>
                </li>
                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user"></i>&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('farmer.logout') }}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                           <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('farmer.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
<!--                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dist/img/user.jpg') }}" class="user-image" alt="User Image">
                        @auth<span class="hidden-xs">{{ Auth::user()->name }}</span>@endauth
                    </a>
                    <ul class="dropdown-menu">
                         User image 
                        <li class="user-header">
                            <img src="{{ asset('dist/img/user.jpg') }}" class="img-circle" alt="User Image">

                            @auth <p>{{ Auth::user()->name }}</p> @endauth
                        </li>
                         Menu Footer
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('farmer.logout') }}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('farmer.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user"></i>&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                           <i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp; Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </li>-->
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
<!--        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @auth <p>{{ Auth::user()->name }}</p> @endauth
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->
<center><div id="google_translate_element"  class="sidebar-form"></div></center>
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
            <li class="{{ checkActive(['farmer'])}}">
                <a href="{{ url('/farmer')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if(count($farmer->schemes))
            <li class="{{ checkActive(['farmer/schemes'])}}">
                <a href="{{ url('/farmer/schemes')}}">
                    <i class="fa fa-cog"></i> <span>Schemes</span>
                </a>
            </li>
            @endif
         </ul>
    </section>
    <!-- /.sidebar -->
</aside>