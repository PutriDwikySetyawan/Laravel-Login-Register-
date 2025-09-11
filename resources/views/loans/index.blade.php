@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Daftar Peminjaman</h2>
<a href="{{ route('loans.create') }}" class="bg-green-600 text-white px-3 py-2 rounded">Pinjam Buku</a>
<table class="w-full border mt-4">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Buku</th>
            <th class="p-2 border">Peminjam</th>
            <th class="p-2 border">Tanggal Pinjam</th>
            <th class="p-2 border">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
        <tr>
            <td class="border p-2">{{ $loan->book->title }}</td>
            <td class="border p-2">{{ $loan->user->name }}</td>
            <td class="border p-2">{{ $loan->loaned_at }}</td>
            <td class="border p-2">{{ $loan->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
