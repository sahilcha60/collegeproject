<aside class="w-64 bg-gray-900 min-h-screen text-gray-300 flex-shrink-0">
    <div class="h-16 flex items-center px-6 bg-gray-950 text-white text-xl font-bold tracking-wider">
        🎓 College ERP
    </div>
    <nav class="mt-4 px-4 space-y-1 pb-8">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">🏠</span> Dashboard
        </a>

        {{-- Academic --}}
        <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Academic</div>

        <a href="{{ route('admin.departments.index') }}"
            class="{{ request()->routeIs('admin.departments.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">🏛️</span> Departments
        </a>
        <a href="{{ route('admin.semesters.index') }}"
            class="{{ request()->routeIs('admin.semesters.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">📅</span> Semesters
        </a>
        <a href="{{ route('admin.subjects.index') }}"
            class="{{ request()->routeIs('admin.subjects.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">📚</span> Subjects
        </a>

        {{-- People --}}
        <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">People</div>

        <a href="{{ route('admin.teachers.index') }}"
            class="{{ request()->routeIs('admin.teachers.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">👨‍🏫</span> Teachers
        </a>
        <a href="{{ route('admin.students.index') }}"
            class="{{ request()->routeIs('admin.students.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">🎒</span> Students
        </a>

        {{-- Examinations --}}
        <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Examinations</div>

        <a href="{{ route('admin.exams.index') }}"
            class="{{ request()->routeIs('admin.exams.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">📝</span> Exams
        </a>
        <a href="{{ route('admin.exam-schedules.index') }}"
            class="{{ request()->routeIs('admin.exam-schedules.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">🗓️</span> Exam Schedules
        </a>
        <a href="{{ route('admin.results.index') }}"
            class="{{ request()->routeIs('admin.results.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">📊</span> Results
        </a>

        {{-- Communication --}}
        <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Communication</div>

        <a href="{{ route('admin.notices.index') }}"
            class="{{ request()->routeIs('admin.notices.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} flex items-center py-2.5 px-4 rounded transition duration-200">
            <span class="mr-3">📢</span> Notices
        </a>
    </nav>
</aside>
