<div class="navbar-header shadow-1">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-4">
                <button type="button" class="sidebar-mobile-toggle" aria-label="Sidebar Mobile Toggler Button">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>
                <div class="d-flex align-items-center gap-2">
                    <h6 class="fw-semibold mb-0">@yield('header_title', 'Admin Dashboard')</h6>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" aria-label="Dark & Light Mode Button"></button>

                <div class="dropdown">
                    <button class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-user-3-line text-primary-light text-xl"></i>
                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm p-12 border bg-base shadow">
                        <div class="px-8 py-4 border-bottom mb-8">
                            <h6 class="text-sm mb-0">{{ Auth::user()->name ?? 'Admin' }}</h6>
                            <p class="text-xs text-secondary-light mb-0">Administrator</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
                            <i class="ri-settings-3-line"></i>
                            Profile Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6 w-100">
                                <i class="ri-shut-down-line"></i>
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
