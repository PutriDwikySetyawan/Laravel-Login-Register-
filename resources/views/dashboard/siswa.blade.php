@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Dashboard Siswa</h1>

    @if($currentLoans->count())
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">📚 Buku yang Sedang Dipinjam</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow overflow-hidden">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700">Buku</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700">Tanggal Pinjam</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700">Tanggal Pengembalian</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700">Denda</th>
                            <th class="text-left py-3 px-6 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currentLoans as $loan)
                            @php
                                $now = \Carbon\Carbon::now();
                                $isOverdue = false;
                                $fine = 0;
                                if ($loan->returned_at) {
                                    $expectedReturnDate = \Carbon\Carbon::parse($loan->returned_at);
                                    $overdueDate = $expectedReturnDate->copy()->addWeek();
                                    if ($now->gt($overdueDate)) {
                                        $isOverdue = true;
                                        $fine = 5000;
                                    }
                                }
                            @endphp
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6">{{ $loan->book ? $loan->book->title : 'Buku tidak ditemukan' }}</td>
                                <td class="py-3 px-6">{{ $loan->loaned_at }}</td>
                                <td class="py-3 px-6">{{ $loan->returned_at }}</td>
                                <td class="py-3 px-6 text-red-600 font-semibold">
                                    {{ $isOverdue ? 'Rp ' . number_format($fine, 0, ',', '.') : '-' }}
                                </td>
                                <td class="py-3 px-6">
                                    @if($loan->book)
                                    <form action="{{ route('loans.return', $loan->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition text-sm" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                            Kembalikan
                                        </button>
                                    </form>
                                    @else
                                        <span class="text-gray-500">Tidak dapat dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

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
