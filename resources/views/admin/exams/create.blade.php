@extends('admin.layouts.master')
@section('header_title', 'Create Exam')
@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-6">Create New Exam</h3>
    @include('admin.layouts.partials.alerts')
    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf

        {{-- Exam Name --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Exam Name</label>
            <select name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                <option value="">-- Select Exam Name --</option>
                @foreach(['Mid', 'Pre-board', 'Board'] as $opt)
                    <option value="{{ $opt }}" {{ old('name') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                @endforeach
            </select>
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Exam Type --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
            <select name="type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror">
                <option value="">-- Select Type --</option>
                <option value="college"    {{ old('type') == 'college'    ? 'selected' : '' }}>College</option>
                <option value="university" {{ old('type') == 'university' ? 'selected' : '' }}>University</option>
            </select>
            @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Semester --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
            <select name="semester_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('semester_id') border-red-500 @enderror">
                <option value="">-- Select Semester --</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                        {{ $semester->name }}
                    </option>
                @endforeach
            </select>
            @error('semester_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Start Date --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('start_date') border-red-500 @enderror">
            @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- End Date --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('end_date') border-red-500 @enderror">
            @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">Save</button>
            <a href="{{ route('admin.exams.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
