<aside class="w-64 bg-gray-900 min-h-screen text-gray-300 flex-shrink-0">
    <div class="h-16 flex items-center px-6 bg-gray-950 text-white text-xl font-bold tracking-wider">
        College ERP
    </div>
    <nav class="mt-6 px-4 space-y-2">
        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-2">Core Modules</div>
        
        <a href="{{ route('admin.departments.index') }}" class="{{ request()->routeIs('admin.departments.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} block py-2.5 px-4 rounded transition duration-200">
            Departments
        </a>
        <a href="{{ route('admin.semesters.index') }}" class="{{ request()->routeIs('admin.semesters.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} block py-2.5 px-4 rounded transition duration-200">
            Semesters
        </a>
        <a href="{{ route('admin.subjects.index') }}" class="{{ request()->routeIs('admin.subjects.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} block py-2.5 px-4 rounded transition duration-200">
            Subjects
        </a>
        <a href="{{ route('admin.teachers.index') }}" class="{{ request()->routeIs('admin.teachers.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} block py-2.5 px-4 rounded transition duration-200">
            Teachers
        </a>
        <a href="{{ route('admin.students.index') }}" class="{{ request()->routeIs('admin.students.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} block py-2.5 px-4 rounded transition duration-200">
            Students
        </a>
    </nav>
</aside>
