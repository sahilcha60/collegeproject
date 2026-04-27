@extends('admin.layouts.master')
@section('header_title', 'Add Subject')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-6">Create New Subject</h3>
    @include('admin.layouts.partials.alerts')
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Data Structures"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject Code</label>
            <input type="text" name="code" value="{{ old('code') }}" placeholder="e.g. CS201"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('code') border-red-500 @enderror">
            @error('code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Credits</label>
            <input type="number" name="credits" value="{{ old('credits', 3) }}" min="1" max="10"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('credits') border-red-500 @enderror">
            @error('credits')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
            <select name="department_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('department_id') border-red-500 @enderror">
                <option value="">-- Select Department --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                @endforeach
            </select>
            @error('department_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
            <select name="semester_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('semester_id') border-red-500 @enderror">
                <option value="">-- Select Semester --</option>
                @foreach($semesters as $sem)
                    <option value="{{ $sem->id }}" {{ old('semester_id') == $sem->id ? 'selected' : '' }}>{{ $sem->name }}</option>
                @endforeach
            </select>
            @error('semester_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">Save</button>
            <a href="{{ route('admin.subjects.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
