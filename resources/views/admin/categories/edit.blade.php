@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="max-w-xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.categories.index') }}"
                class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Kategori</h1>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
            @csrf @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kategori <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">{{ old('description', $category->description) }}</textarea>
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1.5">Gambar</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">Update</button>
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 border border-gray-200 hover:bg-gray-50 transition-colors">Batal</a>
            </div>
        </form>
    </div>
@endsection