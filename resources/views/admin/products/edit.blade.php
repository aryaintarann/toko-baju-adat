@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="max-w-3xl">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.products.index') }}"
                class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Produk</h1>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span
                            class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi <span
                        class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1.5">Harga (Rp) <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" min="0"
                        required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                </div>
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1.5">Stok <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0"
                        required
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Produk</label>
                @if($product->image)
                    <div class="mb-3 w-32 h-32 rounded-lg overflow-hidden bg-warm-100">
                        @if(Storage::disk('public')->exists($product->image))
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-warm-400 text-xs">No image</div>
                        @endif
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <span class="text-sm text-gray-700">Produk Unggulan</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">Update
                    Produk</button>
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 border border-gray-200 hover:bg-gray-50 transition-colors">Batal</a>
            </div>
        </form>
    </div>
@endsection