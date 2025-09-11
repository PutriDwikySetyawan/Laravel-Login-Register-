<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg h-screen fixed">
        <div class="p-6 border-b">
            <h1 class="text-xl font-bold text-blue-600">📚 Admin Panel</h1>
        </div>
        <nav class="p-4 space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-100">🏠 Dashboard</a>
            <a href="{{ route('books.index') }}" class="block px-4 py-2 rounded bg-blue-500 text-white">📖 Kelola Buku</a>
            <a href="{{ route('loans.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100">📋 Peminjaman</a>
            <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100">👥 Pengguna</a>
            <a href="{{ route('reports.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100">📊 Laporan</a>
        </nav>
        <div class="absolute bottom-6 w-full px-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">📖 Daftar Buku</h2>
            <a href="{{ route('books.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">+ Tambah Buku</a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Pengarang</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Tahun</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($books as $book)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $book->title }}</td>
                            <td class="px-4 py-3">{{ $book->author }}</td>
                            <td class="px-4 py-3">{{ $book->category }}</td>
                            <td class="px-4 py-3">{{ $book->year }}</td>
                            <td class="px-4 py-3 flex space-x-2">
                                <a href="{{ route('books.edit', $book->id) }}" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">✏️ Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">🗑 Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">Tidak ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
