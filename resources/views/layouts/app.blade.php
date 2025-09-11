<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="flex min-h-screen">
   <!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-indigo-800 to-indigo-600 text-white flex flex-col shadow-lg">
    <div class="p-6 border-b border-indigo-500">
        <h1 class="text-2xl font-bold tracking-wide">📚 Perpustakaan</h1>
    </div>
    <nav class="flex-1 p-6">
        <ul class="space-y-3">
            {{-- Menu untuk ADMIN --}}
            @if(Auth::user()->role === 'admin')
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>🏠</span> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('books.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📖</span> Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('loans.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📝</span> Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>👥</span> Data Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📊</span> Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>⚙️</span> Pengaturan
                    </a>
                </li>
            @endif

            {{-- Menu untuk GURU --}}
            @if(Auth::user()->role === 'guru')
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>🏠</span> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>👥</span> Data Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📊</span> Laporan Pengajaran
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>⚙️</span> Pengaturan
                    </a>
                </li>
            @endif

            {{-- Menu untuk SISWA --}}
            @if(Auth::user()->role === 'siswa')
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>🏠</span> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('books.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📚</span> Katalog Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('loans.create') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📝</span> Form Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('loans.history') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>📖</span> Riwayat Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                        <span>⚙️</span> Pengaturan
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <div class="p-6 border-t border-indigo-500">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 p-2 w-full text-left rounded-lg hover:bg-red-500 transition text-white">
                <span>🚪</span> Logout
            </button>
        </form>
    </div>
</aside>


        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dashboard</h2>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600">👤 {{ Auth::user()->name ?? 'User' }}</span>
                </div>
            </header>

            <!-- Content -->
            <section class="flex-1 p-6 bg-gray-50">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="bg-white p-6 rounded-lg shadow">
                    @yield('content')
                </div>
            </section>
        </main>
    </div>
</body>
</html>
