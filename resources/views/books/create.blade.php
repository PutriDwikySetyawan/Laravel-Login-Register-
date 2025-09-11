@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Tambah Buku</h2>

<form action="{{ route('books.store') }}" method="POST" class="max-w-lg">
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
        <label class="block mb-1">Stok</label>
        <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border p-2 rounded">
        @error('stock')
            <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('books.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
