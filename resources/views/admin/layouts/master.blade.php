<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.layouts.partials.head')
</head>
<body class="font-sans antialiased bg-gray-100 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    @include('admin.layouts.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        @include('admin.layouts.partials.header')

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @include('admin.layouts.partials.footer')
    </div>

    <!-- Scripts -->
    @include('admin.layouts.partials.scripts')
</body>
</html>
