@extends('admin.layouts.master')

@section('header_title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-blue-100 p-3 mr-4"><span class="text-blue-600 text-2xl font-bold">D</span></div>
        <div>
            <p class="text-sm text-gray-500">Departments</p>
            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Department::count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-green-100 p-3 mr-4"><span class="text-green-600 text-2xl font-bold">S</span></div>
        <div>
            <p class="text-sm text-gray-500">Students</p>
            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Student::count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-yellow-100 p-3 mr-4"><span class="text-yellow-600 text-2xl font-bold">T</span></div>
        <div>
            <p class="text-sm text-gray-500">Teachers</p>
            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Teacher::count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 flex items-center">
        <div class="rounded-full bg-purple-100 p-3 mr-4"><span class="text-purple-600 text-2xl font-bold">E</span></div>
        <div>
            <p class="text-sm text-gray-500">Exams</p>
            <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Exam::count() }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Quick Links</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.departments.index') }}" class="block text-center bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg py-3 px-4 transition">Departments</a>
        <a href="{{ route('admin.students.index') }}" class="block text-center bg-green-50 hover:bg-green-100 text-green-700 rounded-lg py-3 px-4 transition">Students</a>
        <a href="{{ route('admin.teachers.index') }}" class="block text-center bg-yellow-50 hover:bg-yellow-100 text-yellow-700 rounded-lg py-3 px-4 transition">Teachers</a>
        <a href="{{ route('admin.exams.index') }}" class="block text-center bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg py-3 px-4 transition">Exams</a>
    </div>
</div>
@endsection
