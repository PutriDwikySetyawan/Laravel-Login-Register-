@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Pinjam Buku</h2>
<form method="POST" action="{{ route('loans.store') }}">
    @csrf
    <div class="mb-3">
        <label>Pilih Buku</label>
        <select name="book_id" class="w-full border p-2 rounded">
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }} (stok: {{ $book->stock }})</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Pinjam</button>
</form>
@endsection
