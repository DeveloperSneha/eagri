<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <center><div id="google_translate_element"  class="sidebar-form"></div></center>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ url('/authority/districts')}}">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ checkActive(['authority/districts/profile']) }}">
                    <a href="{{ url('/authority/districts/profile')}}">
                        <span>Profile</span>
                    </a>
            </li>
            <li class="treeview {{ checkActive(['authority/districts/addsubuser','authority/districts/addsubuser/*/details','authority/districts/addsubuser/*/edit','authority/districts/addsubuser/create','authority/districts/addblockuser','authority/districts/addblockuser/*/details','authority/districts/addblockuser/*/edit','authority/districts/addblockuser/create','authority/districts/addvillageuser/create','authority/districts/addvillageuser','authority/districts/addvillageuser/*/details','authority/districts/addvillageuser/*/edit']) }}">
                <a href="#">
                    <span>Add User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/districts/addsubuser','authority/districts/addsubuser/*/details','authority/districts/addsubuser/*/edit','authority/districts/addsubuser/create']) }}"><a href="{{ url('/authority/districts/addsubuser') }}">ADD User in Subdivision</a></li>
                    <li class="{{ checkActive(['authority/districts/addblockuser','authority/districts/addblockuser/create','authority/districts/addblockuser/*/details','authority/districts/addblockuser/*/edit']) }}"><a href="{{ url('/authority/districts/addblockuser') }}">ADD User in Block</a></li>
                    <li class="{{ checkActive(['authority/districts/addvillageuser','authority/districts/addvillageuser/create','authority/districts/addvillageuser/*/details','authority/districts/addvillageuser/*/edit']) }}"><a href="{{ url('/authority/districts/addvillageuser') }}">ADD User in Village</a></li>
                </ul>
            </li>
            
           <li class="treeview {{ checkActive(['authority/districts/schsubdist','authority/districts/schblockdist']) }}">
                <a href="#">
                    <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/districts/schsubdist']) }}"><a href="{{ url('/authority/districts/schsubdist') }}">Scheme Subdv. Distribution</a></li>
                    <li class="{{ checkActive(['authority/districts/schblockdist']) }}"><a href="{{ url('/authority/districts/schblockdist') }}">Scheme Block Distribution</a></li>
                    <li class=""><a href="{{ url('/authority/districts')}}">Scheme For Approval</a></li>
                    <li class=""><a href="{{ url('/authority/districts')}}">Approved Scheme</a></li>
                    <li class=""><a href="{{ url('/authority/districts')}}">Rejected Scheme</a></li>
                </ul>
            </li> 
<!--             <li class="treeview">
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