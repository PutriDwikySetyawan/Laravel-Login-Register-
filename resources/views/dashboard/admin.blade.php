@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6">Selamat Datang, {{ Auth::user()->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-50 p-6 rounded shadow">
            <h3 class="text-lg font-semibold text-blue-800">Total Buku</h3>
            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Book::count() }}</p>
        </div>
        <div class="bg-green-50 p-6 rounded shadow">
            <h3 class="text-lg font-semibold text-green-800">Peminjaman Aktif</h3>
            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Loan::where('status', 'pinjam')->count() }}</p>
        </div>
        <div class="bg-purple-50 p-6 rounded shadow">
            <h3 class="text-lg font-semibold text-purple-800">Jumlah Pengguna</h3>
            <p class="text-3xl font-bold text-purple-600">{{ \App\Models\User::count() }}</p>
        </div>
    </div>
</div>
@endsection
