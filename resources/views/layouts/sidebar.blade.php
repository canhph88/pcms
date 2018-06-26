<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            @permission('create_sms','view_sms_list')
            <li class="treeview {{ str_contains(Route::current()->getActionName(), 'SMSController@send') || str_contains(Route::current()->getActionName(), 'SMSController@index')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-comment-alt"></i>
                    <span>SMS</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @permission('create_sms')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'SMSController@showSend')?'active':'' }}"><a href="{{ url('sms/send') }}">Send SMS</a></li>
                    @endpermission
                    @permission('view_sms_list')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'SMSController@index')?'active':'' }}"><a href="{{ url('sms') }}">SMS Listing</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('create_incident','view_incidents_list')
            <li class="treeview {{ str_contains(Route::current()->getActionName(), 'IncidentController')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-clipboard-list"></i>
                    <span>Incidents</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('create_incident')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'IncidentController@create')?'active':'' }}"><a href="/incident/create">Create New Incident</a></li>
                    @endpermission
                    @permission('view_incidents_list')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'IncidentController@index')?'active':'' }}"><a href="/incident">Incident Listing</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('create_basic_profile','view_basic_profile','view_profiles_list')
            <li class="treeview {{ str_contains(Route::current()->getActionName(), 'UserController@create') || str_contains(Route::current()->getActionName(), 'UserController@index')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User Accounts</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @permission('create_basic_profile')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'UserController@create')?'active':'' }}"><a href="{{ url('createUser') }}">Create New Account</a></li>
                    @endpermission
                    @permission('view_profiles_list')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'UserController@index')?'active':'' }}"><a href="{{ url('listUser') }}">Manage User Account</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @role('Administrator','IMS Manager')
            <li class="treeview {{ str_contains(Route::current()->getActionName(), 'DepartmentController')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Department</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ str_contains(Route::current()->getActionName(), 'DepartmentController@create')?'active':'' }}"><a href="{{ url('createDepartment') }}">Create New Department</a></li>
                    <li class="{{ str_contains(Route::current()->getActionName(), 'DepartmentController@index')?'active':'' }}"><a href="{{ url('listDepartment') }}">Manage Department</a></li>
                </ul>
            </li>
            @endrole
            @permission('generate_weekly_report_summary', 'generate_safety_&_security_report')
            <li class="treeview {{ str_contains(Route::current()->getActionName(), 'ReportController')?'active':'' }}">
                <a href="#">
                    <i class="fa fa-chart-pie"></i> <span>Reports</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('generate_weekly_report_summary')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'ReportController@weekly')?'active':'' }}"><a href="{{ url('weekly') }}">Generate Weekly Report</a></li>
                    @endpermission
                    @permission('generate_safety_&_security_report')
                    <li class="{{ str_contains(Route::current()->getActionName(), 'ReportController@safetysecurity')?'active':'' }}"><a href="{{ url('safetysecurity') }}">Safety & Security Report</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul>
    </section>
</aside>