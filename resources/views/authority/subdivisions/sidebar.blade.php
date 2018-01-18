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
            <li class="treeview {{ checkActive(['authority/subdivisions/subuseradd']) }}">
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
                    'authority/subdivisions/addvillageuser',
                    'authority/subdivisions/addvillageuser/create',
                    'authority/subdivisions/addvillageuser/*/details',
                    'authority/subdivisions/addvillageuser/*/edit']) }}">
                    <a href="{{ url('/authority/subdivisions/addvillageuser') }}">ADD User in Village</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>