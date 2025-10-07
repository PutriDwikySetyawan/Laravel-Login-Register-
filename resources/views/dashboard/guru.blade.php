@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-6">📚 Dashboard Guru</h1>

    <p class="mb-6">Selamat datang, <strong>{{ Auth::user()->name }}</strong> 👋</p>

    <!-- MENU -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-50 p-6 rounded shadow text-center">
            <h3 class="text-lg font-semibold mb-2 text-blue-800">📚 Katalog Buku</h3>
            <p class="text-gray-600 mb-4">Lihat semua koleksi buku di perpustakaan.</p>
            <a href="{{ route('books.index') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Lihat Katalog</a>
        </div>

        <div class="bg-green-50 p-6 rounded shadow text-center">
            <h3 class="text-lg font-semibold mb-2 text-green-800">📝 Form Peminjaman</h3>
            <p class="text-gray-600 mb-4">Ajukan peminjaman buku melalui form peminjaman.</p>
            <a href="{{ route('loans.create') }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Ajukan Peminjaman</a>
        </div>

        <div class="bg-yellow-50 p-6 rounded shadow text-center">
            <h3 class="text-lg font-semibold mb-2 text-yellow-800">📖 Riwayat Peminjaman</h3>
            <p class="text-gray-600 mb-4">Lihat daftar buku yang pernah Anda pinjam.</p>
            <a href="{{ route('loans.history') }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Lihat Riwayat</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-purple-50 p-6 rounded shadow text-center">
            <h3 class="text-lg font-semibold mb-2 text-purple-800">📊 Laporan</h3>
            <p class="text-gray-600 mb-4">Akses laporan peminjaman dan aktivitas.</p>
            <a href="{{ route('reports.index') }}" class="inline-block px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Lihat Laporan</a>
        </div>

        <div class="bg-gray-50 p-6 rounded shadow text-center">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">⚙️ Pengaturan</h3>
            <p class="text-gray-600 mb-4">Kelola pengaturan sistem perpustakaan.</p>
            <a href="{{ route('settings.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Buka Pengaturan</a>
        </div>
    </div>
</div>
@endsection
