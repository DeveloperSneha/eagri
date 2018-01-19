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
            <li class="{{ checkActive(['authority/villages/profile']) }}">
                <a href="{{ url('/authority/villages/profile')}}">
                    <span>Profile</span>
                </a>
            </li>
            <li class="treeview {{ checkActive(['authority/villages/schappreject']) }}">
                <a href="#">
                    <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/villages/schappreject']) }}"><a href="{{ url('authority/villages/schappreject')}}">Scheme For Approval</a></li>
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