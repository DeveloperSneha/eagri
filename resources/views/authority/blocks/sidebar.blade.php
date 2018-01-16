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
            
            
<!--            <li class="treeview {{ checkActive(['authority/schemes','authority/schemes/*','authority/approvedscheme','authority/rejectedscheme','authority/blockwisescheme'])}}">
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
                    <li class="{{ checkActive(['authority/cancelregfarmer']) }}"><a href="{{ url('/authority/cancelregfarmer')}}">Cancel Farmer Registration</a></li>
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
            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>