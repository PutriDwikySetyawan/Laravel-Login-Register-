@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Riwayat Peminjaman</h1>
    @if($loans->count())
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Judul Buku</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Pinjam</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Pengembalian</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Denda</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    @php
                        $expectedReturnDate = \Carbon\Carbon::parse($loan->returned_at);
                        $now = \Carbon\Carbon::now();
                        $isOverdue = false;
                        $fine = 0;
                        if ($loan->status === 'pinjam') {
                            // For active loans, check if current date is more than 1 week past expected return date
                            $overdueDate = $expectedReturnDate->copy()->addWeek();
                            if ($now->gt($overdueDate)) {
                                $isOverdue = true;
                                $fine = 5000;
                            }
                        } elseif ($loan->status === 'kembali' && $loan->actual_returned_at) {
                            // For returned loans, check if actual return date was more than 1 week past expected return date
                            $actualReturnDate = \Carbon\Carbon::parse($loan->actual_returned_at);
                            $overdueDate = $expectedReturnDate->copy()->addWeek();
                            if ($actualReturnDate->gt($overdueDate)) {
                                $isOverdue = true;
                                $fine = 5000;
                            }
                        }
                    @endphp
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loan->book->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $loan->loaned_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($loan->status === 'kembali' && $loan->actual_returned_at)
                                {{ $loan->actual_returned_at }} <small class="text-gray-500">(dikembalikan)</small>
                            @else
                                {{ $loan->returned_at ?? '-' }}
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($loan->status) }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-red-600 font-semibold">
                            {{ $isOverdue ? 'Rp ' . number_format($fine, 0, ',', '.') : '-' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($loan->status === 'pinjam')
                                <form action="{{ route('loans.return', $loan->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition text-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 text-sm">Sudah dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada riwayat peminjaman.</p>
    @endif
</div>
@endsection
