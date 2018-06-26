<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{!! asset('images/logo-header.png') !!}" height="40px"/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{!! asset('images/logo-header.png') !!}" height="40px"/></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle fa fa-bars" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                {{--<li>--}}
                    {{--<a href="{!! url('download-app') !!}" style="padding: 0px 15px;--}}
                        {{--vertical-align: middle;--}}
                        {{--line-height: 50px;--}}
                        {{--display: block;">--}}
                        {{--<i class="fa fa-download"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('messagesList') !!}" style="padding: 0px 15px;--}}
                        {{--vertical-align: middle;--}}
                        {{--line-height: 50px;--}}
                        {{--display: block;">--}}
                        {{--<i class="fa fa-envelope"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li style="display: flex;flex-direction: row;align-items: center; margin-right: 2px">
                    {{ !empty(Auth::user()) ? Auth::user()->fullname : '' }}
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
{{--                        <img src="{{ !empty(Auth::user()->avatar_url) ? \App\Core\Libraries\Utilfile::getFileUpload(Auth::user()->avatar_url) : asset('images/no-avatar.png') }}" class="user-image rounded-circle" alt="User Image">--}}
                        <img src="{{ !empty(Auth::user()->avatar_url) ? 'https://images.weserv.nl/?url='.str_replace(['https://', 'http://'],'',\App\Core\Libraries\Utilfile::getFileUpload(Auth::user()->avatar_url)).'&w=300&h=300&t=square&shape=circle' : asset('images/no-avatar.png') }}" class="user-image rounded-circle" alt="No Avatar">
                    </a>
                    <ul class="dropdown-menu scale-up">
                        <!-- User image -->
                        <li class="user-header">
{{--                            <img src="{{ !empty(Auth::user()->avatar_url) ? \App\Core\Libraries\Utilfile::getFileUpload(Auth::user()->avatar_url) : asset('images/no-avatar.png') }}" class="float-left rounded-circle" alt="User Image" style="height: 80px !important; width: 80px !important;">--}}
                            <img src="{{ !empty(Auth::user()->avatar_url) ? 'https://images.weserv.nl/?url='.str_replace(['https://', 'http://'],'',\App\Core\Libraries\Utilfile::getFileUpload(Auth::user()->avatar_url)).'&w=300&h=300&t=square&shape=circle' : asset('images/no-avatar.png') }}" class="float-left rounded-circle" alt="No Avatar" style="height: 80px !important; width: 80px !important;">

                            <p>{{ !empty(Auth::user()) ? Auth::user()->fullname : '' }}
                                <small class="mb-5">{{ !empty(Auth::user()) ? Auth::user()->email : '' }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            {{--<div class="row no-gutters">--}}
                                {{--<div class="col-12 text-left">--}}
                                    {{--<a href="{{ url('editProfile' ) }}"><i class="fa fa-edit"></i> Edit Profile</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row no-gutters">--}}
                                {{--<div class="col-12 text-left">--}}
                                    {{--<a href="{{ url('editProfile', ['change' => true]) }}"><i class="ion ion-person"></i> Change Password</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- /.row -->
                        </li>
                        <li class="user-body">
                            <div class="row no-gutters">
                                <div class="col-12 text-left">
                                    <a href="{{ url('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-in-alt"></i> Log Out</a>
                                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                        {!!  csrf_field() !!}
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-cog fa-spin"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Admin Birthday</h4>

                            <p>Will be July 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Jhone Updated His Profile</h4>

                            <p>New Email : jhone_doe@demo.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Disha Joined Mailing List</h4>

                            <p>disha@demo.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Code Change</h4>

                            <p>Execution time 15 Days</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Web Design
                            <span class="label label-danger pull-right">40%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 40%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Data
                            <span class="label label-success pull-right">75%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 75%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Order Process
                            <span class="label label-warning pull-right">89%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 89%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Development
                            <span class="label label-primary pull-right">72%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 72%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <input type="checkbox" id="report_panel" class="chk-col-grey" >
                    <label for="report_panel" class="control-sidebar-subheading ">Report panel usage</label>

                    <p>
                        general settings information
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <input type="checkbox" id="allow_mail" class="chk-col-grey" >
                    <label for="allow_mail" class="control-sidebar-subheading ">Mail redirect</label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <input type="checkbox" id="expose_author" class="chk-col-grey" >
                    <label for="expose_author" class="control-sidebar-subheading ">Expose author name</label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <input type="checkbox" id="show_me_online" class="chk-col-grey" >
                    <label for="show_me_online" class="control-sidebar-subheading ">Show me as online</label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <input type="checkbox" id="off_notifications" class="chk-col-grey" >
                    <label for="off_notifications" class="control-sidebar-subheading ">Turn off notifications</label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        <a href="javascript:void(0)" class="text-red margin-r-5"><i class="fa fa-trash-o"></i></a>
                        Delete chat history
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>