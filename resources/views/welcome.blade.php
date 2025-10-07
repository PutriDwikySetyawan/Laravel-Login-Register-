<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang di Sistem Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-blue-600 to-indigo-700 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-blue-700 text-center">Selamat Datang di Sistem Perpustakaan</h1>
        <p class="text-gray-700 mb-6 text-center">Kelola peminjaman buku dengan mudah dan efisien. Silakan login atau daftar untuk memulai.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-100 transition">Register</a>
        </div>
    </div>
</body>
</html>
