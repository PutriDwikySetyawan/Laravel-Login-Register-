 z  @extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold mb-6">Daftar Peminjaman</h1>

    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
        <a href="{{ route('loans.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition inline-block mb-6">
            Pinjam Buku Baru
        </a>
    @endif

    @if($loans->count())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow overflow-hidden">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Buku</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Peminjam</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Tanggal Pinjam</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Tanggal Pengembalian</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Denda</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Aksi</th>
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
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $loan->book->title }}</td>
                            <td class="py-3 px-6">{{ $loan->user->name }}</td>
                            <td class="py-3 px-6">{{ $loan->loaned_at }}</td>
                            <td class="py-3 px-6">
                                @if($loan->status === 'kembali' && $loan->actual_returned_at)
                                    {{ $loan->actual_returned_at }} <small class="text-gray-500">(dikembalikan)</small>
                                @else
                                    {{ $loan->returned_at ?? '-' }}
                                @endif
                            </td>
                            <td class="py-3 px-6 capitalize">{{ $loan->status }}</td>
                            <td class="py-3 px-6 text-red-600 font-semibold">
                                {{ $isOverdue ? 'Rp ' . number_format($fine, 0, ',', '.') : '-' }}
                            </td>
                            <td class="py-3 px-6">
                                @if($loan->status === 'pinjam')
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru' || (Auth::user()->role === 'siswa' && $loan->user_id === Auth::id()))
                                        <form action="{{ route('loans.return', ['loanId' => $loan->id]) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition text-sm">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-sm">-</span>
                                    @endif
                                @else
                                    <span class="text-gray-500 text-sm">Sudah dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">Belum ada data peminjaman.</p>
    @endif
</div>
@endsection
