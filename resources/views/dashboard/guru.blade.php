<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Perpustakaan</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text me-3 text-white">
                            👤 {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h1 class="mb-4">📚 Dashboard Guru</h1>

            <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong> 👋</p>

            <!-- MENU -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card text-center shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat Peminjaman</h5>
                            <p class="text-muted">Lihat daftar buku yang pernah Anda pinjam.</p>
                            <a href="{{ route('loans.history') }}" class="btn btn-warning">Lihat Riwayat</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Laporan</h5>
                            <p class="text-muted">Akses laporan peminjaman dan aktivitas.</p>
                            <a href="{{ route('reports.index') }}" class="btn btn-success">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM PEMINJAMAN -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Form Peminjaman Buku</h5>
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="book_id" class="form-label">Pilih Buku</label>
                            <select class="form-select" name="book_id" id="book_id" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }} (stok: {{ $book->stock }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="loaned_at" class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="loaned_at" id="loaned_at" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
