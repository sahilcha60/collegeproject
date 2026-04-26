@extends('admin.layouts.master')
@section('header_title', 'Publish Notice')
@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-6">Publish New Notice</h3>
    @include('admin.layouts.partials.alerts')
    <form action="{{ route('admin.notices.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Notice title"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea name="content" rows="6" placeholder="Write notice content here..."
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
            @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">Publish</button>
            <a href="{{ route('admin.notices.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
