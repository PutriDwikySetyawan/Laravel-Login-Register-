<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            <a href="{{ route('books.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100">📖 Kelola Buku</a>
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

    <!-- Main content -->
    <main class="ml-64 flex-1 p-8">
        <h2 class="text-2xl font-semibold mb-6">Selamat Datang, {{ Auth::user()->name }}</h2>

        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold">Total Buku</h3>
                <p class="text-2xl font-bold text-blue-600">120</p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold">Peminjaman Aktif</h3>
                <p class="text-2xl font-bold text-green-600">45</p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold">Jumlah Pengguna</h3>
                <p class="text-2xl font-bold text-purple-600">78</p>
            </div>
        </div>
    </main>

</body>
</html>
