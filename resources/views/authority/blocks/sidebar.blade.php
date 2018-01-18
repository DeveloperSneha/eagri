<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <center><div id="google_translate_element"  class="sidebar-form"></div></center>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ url('/authority/blocks')}}">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ checkActive(['authority/blocks/profile']) }}">
                <a href="{{ url('/authority/blocks/profile')}}">
                    <span>Profile</span>
                </a>
            </li>
            <li class="{{ checkActive(['authority/blocks/viuser','authority/blocks/viuser/*/details','authority/blocks/viuser/*/edit']) }}">
                <a href="{{ url('/authority/blocks/viuser','authority/blocks/viuser/*/details','authority/blocks/viuser/*/edit')}}">
                    <span>Add User in Villages</span>
                </a>
            </li>
            <li class="treeview {{ checkActive(['']) }}">
                <a href="#">
                    <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{ url('/authority/districts')}}">Scheme For Approval</a></li>
                    <li class=""><a href="{{ url('/authority/districts')}}">Approved Scheme</a></li>
                    <li class=""><a href="{{ url('/authority/districts')}}">Rejected Scheme</a></li>
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