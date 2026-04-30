@extends('admin.layouts.master')

@section('header_title', 'Admin Dashboard')

@section('content')
@if($stats['pending_requests'] > 0)
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
    <div class="flex items-start gap-3">
        <div class="mt-0.5">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 19.5a7.5 7.5 0 110-15 7.5 7.5 0 010 15z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-yellow-800">There are {{ $stats['pending_requests'] }} pending requests awaiting review.</p>
            <p class="text-sm text-yellow-700">Review them now to keep student and teacher support moving.</p>
            <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center mt-2 text-sm font-medium text-yellow-800 hover:text-yellow-900">View Requests</a>
        </div>
    </div>
</div>
@endif
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-blue-100 p-3 mr-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Departments</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['departments'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-green-100 p-3 mr-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Students</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['students'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-yellow-100 p-3 mr-4">
            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Teachers</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['teachers'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-purple-100 p-3 mr-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Subjects</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['subjects'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-red-100 p-3 mr-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M5 7v14h14V7m-4 0V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v3"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Pending Requests</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_requests'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-cyan-100 p-3 mr-4">
            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-5 8v7m-7-4h14a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Attendance Today</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['today_attendance'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-orange-100 p-3 mr-4">
            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M5 13a7 7 0 1114 0 7 7 0 01-14 0z"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Student Attendance Today</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['student_attendance_today'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-lime-100 p-3 mr-4">
            <svg class="w-8 h-8 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Teacher Attendance Today</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['teacher_attendance_today'] }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Notices -->
    <div class="bg-white rounded-lg shadow">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Recent Notices</h3>
            <a href="{{ route('admin.notices.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($recentNotices as $notice)
            <div class="px-6 py-4 hover:bg-gray-50">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ $notice->title }}</h4>
                        <p class="text-xs text-gray-500 mt-1">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($notice->target == 'student') bg-blue-100 text-blue-700
                                @elseif($notice->target == 'teacher') bg-green-100 text-green-700
                                @else bg-purple-100 text-purple-700 @endif">
                                {{ ucfirst($notice->target) }}
                            </span>
                            • {{ $notice->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <a href="{{ route('admin.notices.show', $notice) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">
                <p>No notices published yet.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Upcoming Exams -->
    <div class="bg-white rounded-lg shadow">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Upcoming Exams</h3>
            <a href="{{ route('admin.exam-schedules.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($upcomingExams as $schedule)
            <div class="px-6 py-4 hover:bg-gray-50">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">{{ $schedule->exam->name ?? 'N/A' }}</h4>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $schedule->subject->name ?? 'N/A' }} • {{ $schedule->exam_date->format('M d, Y') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $schedule->start_time }} - {{ $schedule->end_time }}
                        </p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($schedule->exam_date->isToday()) bg-red-100 text-red-800
                        @elseif($schedule->exam_date->isTomorrow()) bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800 @endif">
                        @if($schedule->exam_date->isToday()) Today
                        @elseif($schedule->exam_date->isTomorrow()) Tomorrow
                        @else {{ $schedule->exam_date->diffForHumans() }} @endif
                    </span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">
                <p>No upcoming exams scheduled.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Quick Links</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <a href="{{ route('admin.departments.index') }}" class="block text-center bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            Departments
        </a>
        <a href="{{ route('admin.students.index') }}" class="block text-center bg-green-50 hover:bg-green-100 text-green-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
            Students
        </a>
        <a href="{{ route('admin.teachers.index') }}" class="block text-center bg-yellow-50 hover:bg-yellow-100 text-yellow-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Teachers
        </a>
        <a href="{{ route('admin.subjects.index') }}" class="block text-center bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            Subjects
        </a>
        <a href="{{ route('admin.notices.index') }}" class="block text-center bg-red-50 hover:bg-red-100 text-red-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
            </svg>
            Notices
        </a>
        <a href="{{ route('admin.requests.index') }}" class="block text-center bg-teal-50 hover:bg-teal-100 text-teal-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18"></path>
            </svg>
            Requests
        </a>
        <a href="{{ route('admin.attendance.students') }}" class="block text-center bg-sky-50 hover:bg-sky-100 text-sky-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-5 8v7m-7-4h14a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
            </svg>
            Attendance
        </a>
        <a href="{{ route('admin.exam-schedules.index') }}" class="block text-center bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-lg py-3 px-4 transition">
            <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            Exam Schedules
        </a>
    </div>
</div>
@endsection
