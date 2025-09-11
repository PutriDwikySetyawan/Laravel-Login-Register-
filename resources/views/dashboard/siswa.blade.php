@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard Siswa</h1>

    <!-- Statistik / Menu Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"> 
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold mb-2">📚 Katalog Buku</h2>
            <p class="text-gray-600 mb-4">Lihat semua koleksi buku di perpustakaan.</p>
            <a href="{{ route('books.index') }}" 
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                Lihat Buku
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold mb-2">📝 Riwayat Peminjaman</h2>
            <p class="text-gray-600 mb-4">Lihat daftar buku yang pernah kamu pinjam.</p>
            <a href="{{ route('loans.history') }}" 
               class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                Lihat Riwayat
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold mb-2">⚙️ Pengaturan</h2>
            <p class="text-gray-600 mb-4">Atur profil dan keamanan akunmu.</p>
            <a href="{{ route('settings.index') }}" 
               class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Pengaturan
            </a>
        </div>
    </div>

    <!-- Form Peminjaman Buku -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Form Peminjaman Buku</h2>
        <form action="{{ route('loans.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Pilih Buku -->
            <div>
                <label for="book_id" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                <select name="book_id" id="book_id" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pinjam -->
            <div>
                <label for="loan_date" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                <input type="date" name="loan_date" id="loan_date" required
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    Pinjam Buku
                </button>
            </div>
        </form>
    </div>
@endsection
