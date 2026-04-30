<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>

    <div>
        <div class="sidebar-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
            </a>
            <button type="button" class="text-xxl d-xl-flex d-none line-height-1 sidebar-toggle text-neutral-500" aria-label="Collapse Sidebar">
                <i class="ri-contract-left-line"></i>
            </button>
        </div>
    </div>

    <div class="mx-16 py-12">
        <div class="dropdown profile-dropdown">
            <button type="button" class="profile-dropdown__button d-flex align-items-center justify-content-between p-10 w-100 overflow-hidden bg-neutral-50 radius-12" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                <span class="d-flex align-items-start gap-10">
                    <span class="w-40-px h-40-px rounded-circle bg-primary-100 d-flex align-items-center justify-content-center flex-shrink-0">
                        <i class="ri-user-3-line text-primary-600"></i>
                    </span>
                    <span class="profile-dropdown__contents">
                        <span class="h6 mb-0 text-md d-block text-primary-light">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="text-secondary-light text-sm mb-0 d-block">Administrator</span>
                    </span>
                </span>
                <span class="profile-dropdown__icon pe-8 text-xl d-flex line-height-1">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end border p-12">
                <li>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
                        <i class="ri-settings-3-line"></i>
                        Profile Settings
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6 w-100">
                            <i class="ri-shut-down-line"></i>
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active-page' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="ri-home-4-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.departments.*') || request()->routeIs('admin.semesters.*') || request()->routeIs('admin.subjects.*') ? 'open' : '' }}">
                <a href="javascript:void(0)">
                    <i class="ri-list-view"></i>
                    <span>Academic</span>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.departments.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Departments</a></li>
                    <li><a href="{{ route('admin.semesters.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Semesters</a></li>
                    <li><a href="{{ route('admin.subjects.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Subjects</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.students.*') || request()->routeIs('admin.teachers.*') ? 'open' : '' }}">
                <a href="javascript:void(0)">
                    <i class="ri-user-follow-line"></i>
                    <span>People</span>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.students.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Students</a></li>
                    <li><a href="{{ route('admin.teachers.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Teachers</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.billings.*') || request()->routeIs('admin.billings.show') ? 'active-page' : '' }}">
                <a href="{{ route('admin.billings.index') }}">
                    <i class="ri-file-dollar-line"></i>
                    <span>Billing</span>
                </a>
            </li>
            <li class="dropdown {{ request()->routeIs('admin.attendance.*') ? 'open' : '' }}">
                <a href="javascript:void(0)">
                    <i class="ri-calendar-check-line"></i>
                    <span>Attendance</span>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.attendance.students') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Student Attendance</a></li>
                    <li><a href="{{ route('admin.attendance.teachers') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Teacher Attendance</a></li>
                    <li><a href="{{ route('admin.attendance.report') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Attendance Report</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('admin.exams.*') || request()->routeIs('admin.exam-schedules.*') || request()->routeIs('admin.results.*') ? 'open' : '' }}">
                <a href="javascript:void(0)">
                    <i class="ri-file-edit-line"></i>
                    <span>Examinations</span>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.exams.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Exams</a></li>
                    <li><a href="{{ route('admin.exam-schedules.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Exam Schedules</a></li>
                    <li><a href="{{ route('admin.results.index') }}"><i class="ri-circle-fill circle-icon w-auto"></i>Results</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.notices.*') ? 'active-page' : '' }}">
                <a href="{{ route('admin.notices.index') }}">
                    <i class="ri-booklet-line"></i>
                    <span>Notices</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.requests.*') ? 'active-page' : '' }}">
                <a href="{{ route('admin.requests.index') }}">
                    <i class="ri-mail-open-line"></i>
                    <span>Requests</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
