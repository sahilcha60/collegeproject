<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    @include('admin.layouts.partials.head')
</head>
<body>
    <div class="overlay bg-black bg-opacity-50 w-100 h-100 position-fixed z-9 visibility-hidden opacity-0 duration-300"></div>

    @include('admin.layouts.partials.sidebar')

    <main class="dashboard-main">
        @include('admin.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="mb-24">
                @include('admin.layouts.partials.alerts')
            </div>
            @yield('content')
        </div>

        @include('admin.layouts.partials.footer')
    </main>

    @include('admin.layouts.partials.scripts')
</body>
</html>
