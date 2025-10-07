<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-blue-800 text-white w-64 min-h-screen p-4">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">📚 Perpustakaan</h1>
                <p class="text-blue-200 text-sm">Selamat datang, {{ Auth::user()->name }}</p>
            </div>

            <nav class="space-y-2">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                        🏠 Dashboard Admin
                    </a>
                    <a href="{{ route('books.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('books.*') ? 'bg-blue-700' : '' }}">
                        📚 Kelola Buku
                    </a>
                    <a href="{{ route('loans.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('loans.*') ? 'bg-blue-700' : '' }}">
                        📝 Kelola Peminjaman
                    </a>
                    <a href="{{ route('users.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('users.*') ? 'bg-blue-700' : '' }}">
                        👥 Kelola Pengguna
                    </a>
                    <a href="{{ route('reports.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('reports.*') ? 'bg-blue-700' : '' }}">
                        📊 Laporan
                    </a>
                    <a href="{{ route('settings.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('settings.*') ? 'bg-blue-700' : '' }}">
                        ⚙️ Pengaturan
                    </a>
                @elseif(Auth::user()->role === 'guru')
                    <a href="{{ route('guru.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('guru.dashboard') ? 'bg-blue-700' : '' }}">
                        🏠 Dashboard Guru
                    </a>
                    <a href="{{ route('books.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('books.*') ? 'bg-blue-700' : '' }}">
                        📚 Katalog Buku
                    </a>
                    <a href="{{ route('loans.create') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('loans.create') ? 'bg-blue-700' : '' }}">
                        📝 Form Peminjaman
                    </a>
                    <a href="{{ route('loans.history') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('loans.history') ? 'bg-blue-700' : '' }}">
                        📖 Riwayat Peminjaman
                    </a>
                    <a href="{{ route('reports.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('reports.*') ? 'bg-blue-700' : '' }}">
                        📊 Laporan
                    </a>
                    <a href="{{ route('settings.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('settings.*') ? 'bg-blue-700' : '' }}">
                        ⚙️ Pengaturan
                    </a>
                @else
                    <a href="{{ route('siswa.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-700' : '' }}">
                        🏠 Dashboard Siswa
                    </a>
                    <a href="{{ route('books.index') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('books.*') ? 'bg-blue-700' : '' }}">
                        📚 Katalog Buku
                    </a>
                    <a href="{{ route('loans.create') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('loans.create') ? 'bg-blue-700' : '' }}">
                        📝 Form Peminjaman
                    </a>
                    <a href="{{ route('loans.history') }}" class="block py-2 px-4 rounded hover:bg-blue-700 {{ request()->routeIs('loans.history') ? 'bg-blue-700' : '' }}">
                        📖 Riwayat Peminjaman
                    </a>
                @endif
            </nav>

            <div class="mt-auto pt-8">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-4 rounded hover:bg-red-700 bg-red-600">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-50">
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
