<header class="bg-white shadow z-10">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('header_title', 'Admin Dashboard')
        </h2>
        
        <div class="flex items-center">
            <span class="text-gray-600 mr-4">{{ Auth::user()->name ?? 'Admin' }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-md transition duration-150 ease-in-out">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</header>
