@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Dashboard Siswa</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-indigo-50 p-6 rounded shadow flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-semibold mb-3 text-indigo-700">📚 Katalog Buku</h2>
                <p class="text-gray-700 mb-4">Lihat semua koleksi buku di perpustakaan dan pinjam buku yang kamu inginkan.</p>
            </div>
            <a href="{{ route('books.index') }}" class="mt-auto inline-block px-5 py-3 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
                Lihat Katalog
            </a>
        </div>

        <div class="bg-indigo-50 p-6 rounded shadow flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-semibold mb-3 text-indigo-700">📝 Form Peminjaman</h2>
                <p class="text-gray-700 mb-4">Ajukan peminjaman buku melalui form peminjaman yang mudah dan cepat.</p>
            </div>
            <a href="{{ route('loans.create') }}" class="mt-auto inline-block px-5 py-3 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
                Ajukan Peminjaman
            </a>
        </div>

        <div class="bg-indigo-50 p-6 rounded shadow flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-semibold mb-3 text-indigo-700">📖 Riwayat Peminjaman</h2>
                <p class="text-gray-700 mb-4">Lihat daftar buku yang pernah kamu pinjam dan status peminjamanmu.</p>
            </div>
            <a href="{{ route('loans.history') }}" class="mt-auto inline-block px-5 py-3 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
                Lihat Riwayat
            </a>
        </div>
    </div>
</div>
@endsection
