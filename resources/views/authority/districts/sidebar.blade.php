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
            
           <li class="treeview {{ checkActive(['authority/districts/schsubdist','authority/districts/schblockdist','authority/districts/aprvrejectscheme/*/view',
                       'authority/districts/aprvrejectscheme','authority/districts/apvrscheme','authority/districts/rejectschemes']) }}">
                <a href="#">
                    <span>Scheme</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/districts/schsubdist']) }}"><a href="{{ url('/authority/districts/schsubdist') }}">Scheme Subdv. Distribution</a></li>
                    <li class="{{ checkActive(['authority/districts/schblockdist']) }}"><a href="{{ url('/authority/districts/schblockdist') }}">Scheme Block Distribution</a></li>
                    <li class="{{ checkActive(['authority/districts/aprvrejectscheme/*/view','authority/districts/aprvrejectscheme']) }}"><a href="{{ url('/authority/districts/aprvrejectscheme')}}">Scheme For Approval</a></li>
                    <li class="{{ checkActive(['authority/districts/apvrscheme']) }}"><a href="{{ url('/authority/districts/apvrscheme')}}">Approved Scheme</a></li>
                    <li class="{{ checkActive(['authority/districts/rejectschemes']) }}"><a href="{{ url('/authority/districts/rejectschemes')}}">Rejected Scheme</a></li>
                </ul>
            </li> 
            <li class="treeview {{ checkActive(['authority/districts/farmer-reg'])}}">
                <a href="#">
                    <span>Farmer Section</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ checkActive(['authority/districts/farmer-reg'])}}"><a href="{{ url('authority/districts/farmer-reg')}}">Registered Farmer</a></li>
                    <li class=""><a href="#">Blacklisted Farmer</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>