<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">📚 Katalog Buku</h1>
        @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="flex space-x-2">
                <a href="{{ route('books.create') }}"
                   class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    + Tambah Buku
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    ⬅️ Kembali ke Dashboard Admin
                </a>
            </div>
        @else
            <a href="{{ route('siswa.dashboard') }}"
               class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                ⬅️ Kembali ke Dashboard
            </a>
        @endif
    </header>

    <!-- Grid Buku -->
    <main class="p-6">
        @if($books->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($books as $book)
                    <div class="bg-white rounded shadow hover:shadow-lg transition p-4">
                        <!-- Cover -->
                        @if($book->cover) {{-- pastikan ada field cover/path --}}
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 alt="{{ $book->title }}"
                                 class="w-full h-48 object-cover rounded mb-3">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded mb-3">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif

                        <!-- Info Buku -->
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $book->title }}</h2>
                        <p class="text-sm text-gray-600 mb-1">Pengarang: {{ $book->author }}</p>
                        <p class="text-sm text-gray-600 mb-1">Kategori: {{ $book->category }}</p>
                        <p class="text-sm text-gray-600">Stok: 
                            <span class="font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $book->stock }}
                            </span>
                        </p>

                        <!-- Tombol Pinjam (opsional) -->
                        @if($book->stock > 0)
                            {{-- Remove the Pinjam button as per user request --}}
                        @else
                            <span class="mt-3 inline-block w-full text-center px-4 py-2 bg-gray-400 text-white rounded cursor-not-allowed">
                                Stok Habis
                            </span>
                        @endif

                        <!-- Tombol Admin: Edit dan Hapus -->
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <div class="mt-3 flex space-x-2">
                                <a href="{{ route('books.edit', $book) }}"
                                   class="flex-1 text-center px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="flex-1"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada buku di katalog.</p>
        @endif
    </main>

</body>
</html>
