@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Tambah Buku</h2>

<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="block mb-1">Judul</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full border p-2 rounded">
        @error('title')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="block mb-1">Penulis</label>
        <input type="text" name="author" value="{{ old('author') }}" class="w-full border p-2 rounded">
        @error('author')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="block mb-1">Kategori</label>
        <input type="text" name="category" value="{{ old('category') }}" class="w-full border p-2 rounded">
        @error('category')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="block mb-1">Tahun</label>
        <input type="number" name="year" value="{{ old('year') }}" class="w-full border p-2 rounded">
        @error('year')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="block mb-1">Stok</label>
        <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border p-2 rounded">
        @error('stock')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cover" class="block text-gray-700">Cover Buku</label>
        <input type="file" name="cover" id="cover" class="border p-2 w-full">
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
    <a href="{{ route('books.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
