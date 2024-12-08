<nav class="navbar navbar-vertical navbar-expand-lg" data-navbar-appearance="darker">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a
                            class="nav-link dropdown-indicator label-1"
                            href="#nv-home"
                            role="button"
                            data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="nv-home">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span
                                        class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><span data-feather="pie-chart"></span></span><span class="nav-link-text">Home</span><span
                                    class="fa-solid fa-circle text-info ms-1 new-page-indicator"
                                    style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul
                                class="nav collapse parent show"
                                data-bs-parent="#navbarVerticalCollapse"
                                id="nv-home">
                                <li class="collapsed-nav-item-title d-none">Home</li>
                                @if (Auth::user()->can('hrms.menu'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('hr.emp.dashboard') }}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">HRMS</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">Apps</p>
                    <hr class="navbar-vertical-line" />
                    <!-- parent pages-->

                    <!-- ************* HRMS **************** -->
                    @if (Auth::user()->can('hrms.menu'))
                    <div class="nav-item-wrapper">
                        <a
                            class="nav-link dropdown-indicator label-1 {{ Request::is('hr/*')||Request::is('hr/payroll/*') ? '' : 'collapsed' }}"
                            href="#nv-hrms"
                            role="button"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('hr/*') ? 'true' : 'false' }}"
                            aria-controls="nv-hrms">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span
                                        class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><i class="fa fa-users text-primary" aria-hidden="true"></i></span><span class="nav-link-text">HRMS (User)</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul
                                class="nav collapse parent {{ Request::is('hr/*')||Request::is('tracki/setting/*')||Request::is('hr/payroll*') ? 'show' : '' }}"
                                data-bs-parent="#navbarVerticalCollapse"
                                id="nv-hrms">
                                <li class="collapsed-nav-item-title d-none">
                                    HRMS
                                </li>
                                @if (Auth::user()->hasrole('Manager'))
                                <li class="nav-item">
                                    <a
                                        class="nav-link dropdown-indicator {{ Request::is('hr/manager/*') ? '' : 'collapsed' }}"
                                        href="#nv-manager"
                                        data-bs-toggle="collapse"
                                        aria-expanded="{{ Request::is('hr/manager/*') ? 'true' : 'false' }}"
                                        aria-controls="nv-manager">
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown-indicator-icon-wrapper">
                                                <span
                                                    class="fas fa-caret-right dropdown-indicator-icon"></span>
                                            </div>
                                            <span class="nav-link-text">Manager</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <div class="parent-wrapper">
                                        <ul
                                            class="nav collapse parent {{ Request::is('hr/manager*') ? 'show' : '' }}"
                                            data-bs-parent="#manager"
                                            id="nv-manager">
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('hr/manager') ? 'active' : '' }}"
                                                    href="{{ route('hr.manager') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Employees</span>
                                                    </div>
                                                </a>
                                                <!-- more inner pages-->
                                            </li>
                                            @can('leave.show')
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('tracki/employee/managers/leave') ? 'active' : '' }}"
                                                    href="{{ route('tracki.employee.managers.leave') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Leaves</span>
                                                    </div>
                                                </a>
                                                <!-- more inner pages-->
                                            </li>
                                            @endcan
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('hr/manager/timesheet') ? 'active' : '' }}"
                                                    href="{{ route('hr.manager.timesheet') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Time Sheets</span>
                                                    </div>
                                                </a>
                                                <!-- more inner pages-->
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif
                                @if (Auth::user()->hasrole('Payroll'))
                                <li class="nav-item">
                                    <a
                                        class="nav-link dropdown-indicator {{ Request::is('hr/payroll/*') ? '' : 'collapsed' }}"
                                        href="#nv-payroll"
                                        data-bs-toggle="collapse"
                                        aria-expanded="{{ Request::is('hr/employee/*') ? 'true' : 'false' }}"
                                        aria-controls="nv-payroll">
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown-indicator-icon-wrapper">
                                                <span
                                                    class="fas fa-caret-right dropdown-indicator-icon"></span>
                                            </div>
                                            <span class="nav-link-text">Payroll</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                    <div class="parent-wrapper">
                                        <ul
                                            class="nav collapse parent {{ Request::is('hr/payroll*') ? 'show' : '' }}"
                                            data-bs-parent="#payroll"
                                            id="nv-payroll">
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('hr/payroll/timesheet') ? 'active' : '' }}"
                                                    href="{{ route('hr.payroll.timesheet') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Timesheets</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('hr/payroll/timesheet/missing') ? 'active' : '' }}"
                                                    href="{{ route('hr.payroll.timesheet.missing') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Missing Timesheets</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('hr/payroll/bank') ? 'active' : '' }}"
                                                    href="{{ route('hr.payroll.bank') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Bank File</span>
                                                    </div>
                                                </a>
                                                <!-- more inner pages-->
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    class="nav-link {{ Request::is('hr/payroll/payment') ? 'active' : '' }}"
                                                    href="{{ route('hr.payroll.payment') }}">
                                                    <div class="d-flex align-items-center">
                                                        <span class="nav-link-text">Payment File</span>
                                                    </div>
                                                </a>
                                                <!-- more inner pages-->
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endif

                                @can('leave.show')
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/employee/leave') ? 'active' : '' }} label-1"
                                        href="{{route('tracki.employee.leave')}}" role="button">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Leaves</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('hr/emp/timesheet') ? 'active' : '' }} label-1"
                                        href="{{ route('hr.emp.timesheet') }}" role="button">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Time Sheet</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('hr/emp/emergency') ? 'active' : '' }} label-1"
                                        href="{{ route('hr.emp.emergency') }}" role="button">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Emergenct Contact</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </li>

                @if (Auth::user()->can('roles.permissions.menu')||Auth::user()->can('manage.admin.users.menu'))
                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">Security/Privacy</p>
                    <hr class="navbar-vertical-line" />
                    <!-- parent pages-->
                    @if (Auth::user()->can('roles.permissions.menu'))
                    <div class="nav-item-wrapper">
                        <a
                            class="nav-link dropdown-indicator label-1 {{ Request::is('tracki/sec/permissions/*')
                                                                        ||Request::is('tracki/sec/roles/*')
                                                                        ||Request::is('tracki/sec/groups/*') ? '' : 'collapsed' }}"
                            href="#nv-security-privacy"
                            role="button"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('tracki/sec/permissions/*')||Request::is('tracki/sec/roles/*')
                                                                                     ||Request::is('tracki/sec/groups/*')
                                                                                     ||Request::is('tracki/sec/groups/*') ? 'true' : 'false' }}"
                            aria-controls="nv-security-privacy">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span
                                        class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><i class="fa-solid fa-user-shield text-warning"></i></span><span class="nav-link-text">Roles & Permissioins</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul
                                class="nav collapse parent {{ Request::is('tracki/sec/permissions/*')
                                                            ||Request::is('tracki/sec/roles/*')
                                                            ||Request::is('tracki/sec/groups/*') ? 'show' : '' }}"
                                data-bs-parent="#navbarVerticalCollapse"
                                id="nv-security-privacy">
                                <li class="collapsed-nav-item-title d-none">Roles & Permissioins</li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/sec/permissions/list') ? 'active' : '' }}"
                                        href="{{route('tracki.sec.perm.list')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">All Permissions</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/sec/roles/roles/list') ? 'active' : '' }}"
                                        href="{{route('tracki.sec.roles.list')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">All Roles</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/sec/rolesetup/list') ? 'active' : '' }}"
                                        href=" {{route('tracki.sec.rolesetup.list')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">List Roles in Permission</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <!-- <li
                                    class="nav-item"><a class="nav-link"
                                    href="{{route('tracki.sec.rolesetup.add')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Role in Permission</span>
                                        </div>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/sec/groups/groups/list') ? 'active' : '' }}"
                                        href="{{route('tracki.sec.groups.list')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Groups</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                    <!-- parent pages-->
                    @if (Auth::user()->can('manage.admin.users.menu'))
                    <div class="nav-item-wrapper">
                        <a
                            class="nav-link dropdown-indicator label-1 {{ Request::is('tracki/sec/adminuser/*') ? '' : 'collapsed' }}"
                            href="#nv-manage-users"
                            role="button"
                            data-bs-toggle="collapse"
                            aria-expanded="{{ Request::is('tracki/sec/adminuser/*') ? 'true' : 'false' }}"
                            aria-controls="nv-manage-users">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span
                                        class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><i class="fa-solid fa-user-shield text-warning"></i></span><span class="nav-link-text">Manage Users</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul
                                class="nav collapse parent {{ Request::is('tracki/sec/adminuser/*') ? 'show' : '' }}"
                                data-bs-parent="#navbarVerticalCollapse"
                                id="nv-manage-users">
                                <li class="collapsed-nav-item-title d-none">Manage Users</li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/sec/adminuser/list') ? 'active' : '' }}"
                                        href="{{route('tracki.sec.adminuser.list')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">All users</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link {{ Request::is('tracki/sec/adminuser/add') ? 'active' : '' }}"
                                        href="{{route('tracki.sec.adminuser.add')}}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Add users</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </li>
                @endif

                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">Documentation</p>
                    <hr class="navbar-vertical-line" />
                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a
                            class="nav-link label-1"
                            href="#"
                            role="button"
                            data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span data-feather="life-buoy"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Getting started</span></span>
                            </div>
                        </a>
                    </div>
                    <!-- <div class="nav-item-wrapper">
                        <a
                            class="nav-link dropdown-indicator label-1"
                            href="#nv-customization"
                            role="button"
                            data-bs-toggle="collapse"
                            aria-expanded="false"
                            aria-controls="nv-customization">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span
                                        class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><span data-feather="settings"></span></span><span class="nav-link-text">Customization</span><span
                                    class="fa-solid fa-circle text-info ms-1 new-page-indicator"
                                    style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul
                                class="nav collapse parent"
                                data-bs-parent="#navbarVerticalCollapse"
                                id="nv-customization">
                                <li class="collapsed-nav-item-title d-none">
                                    Customization
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/customization/configuration.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Configuration</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/customization/styling.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Styling</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/customization/color.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Color</span><span
                                                class="badge ms-2 badge badge-phoenix badge-phoenix-warning">New</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/customization/dark-mode.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Dark mode</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/customization/plugin.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Plugin</span>
                                        </div>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- <div class="nav-item-wrapper">
                        <a
                            class="nav-link dropdown-indicator label-1"
                            href="#nv-layouts-doc"
                            role="button"
                            data-bs-toggle="collapse"
                            aria-expanded="false"
                            aria-controls="nv-layouts-doc">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span
                                        class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><span data-feather="table"></span></span><span class="nav-link-text">Layouts doc</span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul
                                class="nav collapse parent"
                                data-bs-parent="#navbarVerticalCollapse"
                                id="nv-layouts-doc">
                                <li class="collapsed-nav-item-title d-none">
                                    Layouts doc
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/layouts/vertical-navbar.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Vertical navbar</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/layouts/horizontal-navbar.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Horizontal navbar</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/layouts/combo-navbar.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Combo navbar</span>
                                        </div>
                                    </a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="documentation/layouts/dual-nav.html">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-text">Dual nav</span>
                                        </div>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- <div class="nav-item-wrapper">
                        <a
                            class="nav-link label-1"
                            href="documentation/gulp.html"
                            role="button"
                            data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span
                                        class="fa-brands fa-gulp ms-1 me-1 fa-lg"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Gulp</span></span>
                            </div>
                        </a>
                    </div> -->
                    <!-- <div class="nav-item-wrapper">
                        <a
                            class="nav-link label-1"
                            href="documentation/design-file.html"
                            role="button"
                            data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span data-feather="figma"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Design file</span></span>
                            </div>
                        </a>
                    </div> -->
                    <!-- <div class="nav-item-wrapper">
                        <a
                            class="nav-link label-1"
                            href="changelog.html"
                            role="button"
                            data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span data-feather="git-merge"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Changelog</span></span>
                            </div>
                        </a>
                    </div> -->
                    <!-- <div class="nav-item-wrapper">
                        <a
                            class="nav-link label-1"
                            href="showcase.html"
                            role="button"
                            data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><span data-feather="monitor"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Showcase</span></span>
                            </div>
                        </a>
                    </div> -->
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span>
        </button>
    </div>
</nav>