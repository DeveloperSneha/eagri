<header class="main-header navbar  navbar-fixed-top head-top">
    <!-- Logo -->
    <a href="{{ url('/index')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Agri</b></span>
        <span class="logo-lg"><b>Agriculture Department <br>Haryana</b></span>
        <!-- logo for regular state and mobile devices -->
<!--        <span class="logo-lg"><img src="{{asset('dist/img/logo.png') }}" alt="User Image" height="45" width="200"></span>-->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-1 txt-cnt fl">
                        <span id="Master_lbl_first" class="digital" style="font-size:Small;">Reg. Farmers</span><br>
                        <!--added count of regFarmers-->
                        <span id="spnpermits" class="digital f-b">{{$users = DB::table('farmers')->distinct('idFarmer')->get()->count()}}</span>
                        <!--end count of regFarmers-->
                    </div>

                </li>
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-3 txt-cnt fl">

                        <span id="Master_lbl_second" class="digital" style="font-size:Small;">Total Schemes</span><br>
                        <!--added count of scheme-->
                        <span id="spntransitforms" class="digital f-b">{{$users = DB::table('scheme')->distinct('idScheme')->get()->count()}}</span>
                        <!--end count of scheme-->
                    </div>
                </li>
                <li class="dropdown notifications-menu">
                    <div class="parallelogram bg-1 txt-cnt fl">
                        <span id="Master_lbl_third" class="digital" style="font-size:Small;">Total Program's</span><br>
                        <!--added count of Program-->
                        <span id="spnstationery" class="digital f-b">{{$users = DB::table('program')->distinct('idProgram')->get()->count()}}</span>
                        <!--end count of Program-->
                    </div>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
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
                                                <a href="{{ url('/')}}" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                                   onclick="event.preventDefault();
                                                           document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </li>-->
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
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

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
            <li class="{{ checkActive(['/index']) }}">
                <a href="{{ url('/index')}}">
                    <span>HOME</span>
                </a>
            </li>
            @can('add-user')
            <li class="treeview {{ checkActive(['useradm','roles','roles/*/permissions','roles/*/edit','permissions','permissions/*/edit']) }}">
                <a href="#">
                    <span>Admin Users, Roles & Permissions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['useradm','useradm/*/edit'])}}"><a href="{{ url('/useradm')}}">Add User-Admin </a></li>
                    <li class="{{ checkActive(['roles','roles/*/edit','roles/*/permissions'])}}"><a href="{{ url('/roles')}}">Roles</a></li>
                    <li class="{{ checkActive(['permissions','permissions/*/edit'])}}"><a href="{{ url('/permissions')}}">Permissions</a></li>
                </ul>
            </li>
            @endcan
            <li class="treeview {{ checkActive(['userdistrict','uservillage/*/edituser','userdistrict/create','userdistrict/*/edituser','userdistrict/*/edit','usersubdivision','usersubdivision/create','usersubdivision/*/edit','usersubdivision/*/edituser','userblock','userblock/create','userblock/*/edit','userblock/*/edituser','uservillage','uservillage/create','uservillage/*/edit']) }}">
                <a href="#">
                    <span>Add User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['userdistrict','userdistrict/create','userdistrict/*/edituser','userdistrict/*/edit']) }}"><a href="{{ url('/userdistrict') }}">ADD User in District</a></li>
                    <li class="{{ checkActive(['usersubdivision','usersubdivision/create','usersubdivision/*/edituser','usersubdivision/*/edit']) }}"><a href="{{ url('/usersubdivision') }}">ADD User in Subdivision</a></li>
                    <li class="{{ checkActive(['userblock','userblock/create','userblock/*/edituser','userblock/*/edit']) }}"><a href="{{ url('/userblock') }}">ADD User in Block</a></li>
                    <li class="{{ checkActive(['uservillage','uservillage/create','uservillage/*/edituser','uservillage/*/edit']) }}"><a href="{{ url('/uservillage') }}">ADD User in Village</a></li>
                </ul>
            </li>
            <!--            <li class="{{ checkActive(['roles'])}}">
                            <a href="{{ url('/roles') }}">
                               <span>Roles</span>
                            </a>
                        </li>-->
            <li class="treeview {{ checkActive([
            'units',
            'units/*/editunit',
            'units/*/deleteunit',
            'designations',
            'designations/*/editdesignation',
            'designations/*/deletedesignation',
            'programs',
            'programs/*/editprogram',
            'programs/*/deleteprogram',
            'schemes',
            'schemes/*/editscheme',
            'schemes/*/deletescheme',
            'sections',
            'sections/*/editsection',
            'sections/*/deletesection',
            'workflow',
            'workflow/*/editworkflow',
            'workflow/*/deleteworkflow',
            'fys',
            'fys/*/editfys',
            'fys/*/deletefys',
            'certificates',
            'certificates/*/editcertificate',
            'certificates/*/deletecertificate',
            'districtdistribution',
            
            ]) }}">
                <a href="#">
                    <span>Masters</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['sections','sections/*/editsection','sections/*/deletesection']) }}"><a href="{{ url('/sections') }}">Section</a></li>
                    <li class="{{ checkActive(['schemes','schemes/*/editscheme','schemes/*/deletescheme']) }}"><a href="{{ url('/schemes') }}">Scheme</a></li>
                    <li class="{{ checkActive(['programs','programs/*/editprogram','programs/*/deleteprogram']) }}"><a href="{{ url('/programs') }}">Program</a></li>
                    <li class="{{ checkActive(['designations','designations/*/editdesignation',          'designations/*/deletedesignation']) }}"><a href="{{ url('/designations') }}">Designations</a></li>
                    <li class="{{ checkActive(['workflow','workflow/*/editworkflow','workflow/*/deleteunit']) }}"><a href="{{ url('/workflow') }}">Workflows</a></li>
                    <li class="{{ checkActive(['units','units/*/editunit','units/*/deleteunit']) }}"><a href="{{ url('/units') }}">Units</a></li>
                    <li class="{{ checkActive(['fys','fys/*/editfys','fys/*/deletefys',]) }}"><a href="{{ url('/fys') }}">Financial Year</a></li>
                    <li class="{{ checkActive(['certificates','certificates/*/editcertificate','certificates/*/deletecertificate',]) }}"><a href="{{ url('/certificates') }}">Certificates</a></li>

                </ul>
            </li>

            <li class="treeview {{ checkActive(['schemeactivations/nv','schemeactivations/nv/*/edit','districtdistribution']) }}">
                <a href="#">
                    <span>Non Vendor</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['schemeactivations/nv','schemeactivations/nv/*/edit']) }}"><a href="{{ url('/schemeactivations/nv') }}">Scheme Activation</a></li>
                    <li class="{{ checkActive(['districtdistribution']) }}"><a href="{{ url('/districtdistribution') }}">Scheme Distribution District</a></li>

                </ul>
            </li>
            <!--            <li class="treeview {{ checkActive(['components','categories','compcerts','compsizes','comprates','schemeactivations','blockdistribution','villagedistribution']) }}">
                            <a href="#">
                                <span>Vendor</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ checkActive(['categories']) }}"><a href="{{ url('/categories') }}">Item</a></li>
                                <li class="{{ checkActive(['components']) }}"><a href="{{ url('/components') }}">Component</a></li>
                                <li class="{{ checkActive(['compcerts']) }}"><a href="{{ url('/compcerts') }}">Component Certificates</a></li>
                                <li class="{{ checkActive(['compsizes']) }}"><a href="{{ url('/compsizes') }}">Component Size</a></li>
                                <li class="{{ checkActive(['comprates']) }}"><a href="{{ url('/comprates') }}">Component Rates</a></li>
                                <li class="{{ checkActive(['schemeactivations']) }}"><a href="{{ url('/schemeactivations') }}">Scheme Activation</a></li>
                                <li class="{{ checkActive(['districtdistribution']) }}"><a href="{{ url('/districtdistribution') }}"><i class="fa fa-circle-o"></i>Scheme Distribution District</a></li>
                                <li class="{{ checkActive(['blockdistribution']) }}"><a href="{{ url('/blockdistribution') }}">Scheme Distribution Block</a></li>
                                <li class="{{ checkActive(['villagedistribution']) }}"><a href="{{ url('/villagedistribution') }}">Scheme Distribution Village</a></li>
            
                            </ul>
                        </li>-->
        </ul>
    </section>
<!--     <center  style="color:#fff;">
         <strong>Version - 1.0</strong>
    </center>-->
    <!-- /.sidebar -->
</aside>