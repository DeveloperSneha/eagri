<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <center><div id="google_translate_element"  class="sidebar-form"></div></center>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ url('/authority/subdivisions')}}">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ checkActive(['authority/subdivisions/profile']) }}">
                <a href="{{ url('/authority/subdivisions/profile')}}">
                    <span>Profile</span>
                </a>
            </li>
            <li class="treeview {{ checkActive(['authority/subdivisions/blockuseradd',
                        'authority/subdivisions/blockuseradd/create',
                    'authority/subdivisions/blockuseradd/*/details',
                    'authority/subdivisions/blockuseradd/*/edit',
                'authority/subdivisions/addviuser',
                    'authority/subdivisions/addviuser/create',
                    'authority/subdivisions/addviuser/*/details',
                    'authority/subdivisions/addviuser/*/edit']) }}">
                <a href="#">
                    <span>Add User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive([
                    'authority/subdivisions/blockuseradd',
                    'authority/subdivisions/blockuseradd/create',
                    'authority/subdivisions/blockuseradd/*/details',
                    'authority/subdivisions/blockuseradd/*/edit']) }}">
                        <a href="{{ url('/authority/subdivisions/blockuseradd') }}">ADD User in Block</a></li>
                    <li class="{{ checkActive([
                    'authority/subdivisions/addviuser',
                    'authority/subdivisions/addviuser/create',
                    'authority/subdivisions/addviuser/*/details',
                    'authority/subdivisions/addviuser/*/edit']) }}">
                        <a href="{{ url('/authority/subdivisions/addviuser') }}">ADD User in Village</a></li>
                </ul>
            </li>
            <li class="treeview {{ checkActive(['authority/subdivisions/blockdist']) }}">
                <a href="#">
                    <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/subdivisions/blockdist']) }}"><a href="{{ url('/authority/subdivisions/blockdist') }}">Scheme Block Distribution</a></li>
                    <li class=""><a href="{{ url('#')}}">Scheme For Approval</a></li>
                    <li class=""><a href="{{ url('#')}}">Approved Scheme</a></li>
                    <li class=""><a href="{{ url('#')}}">Rejected Scheme</a></li>
                </ul>
            </li> 
            <li class="treeview {{ checkActive([''])}}">
                <a href="#">
                    <span>Farmer Section</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="#">Registered Farmer</a></li>
                    <li class=""><a href="#">Cancel Farmer Registration</a></li>
                    <li class=""><a href="#">Blacklisted Farmer</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>