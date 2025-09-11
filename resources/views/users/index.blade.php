<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <style>
        /* General Style */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background: #f9fafc;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        a {
            text-decoration: none;
        }

        /* Button Tambah */
        .btn-tambah {
            display: inline-block;
            padding: 10px 16px;
            background: #3498db;
            color: #fff;
            border-radius: 6px;
            transition: background 0.3s ease;
            font-size: 14px;
        }
        .btn-tambah:hover {
            background: #2980b9;
        }

        /* Button Kembali */
        .btn-kembali {
            display: inline-block;
            padding: 10px 16px;
            background: #7f8c8d;
            color: #fff;
            border-radius: 6px;
            transition: background 0.3s ease;
            font-size: 14px;
            margin-right: 8px;
        }
        .btn-kembali:hover {
            background: #636e72;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
        }

        th {
            background: #2c3e50;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #eaf3ff;
        }

        /* Action Buttons */
        .btn-edit, .btn-hapus {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            border: none;
        }

        .btn-edit {
            background: #27ae60;
            color: #fff;
        }
        .btn-edit:hover {
            background: #1e8449;
        }

        .btn-hapus {
            background: #e74c3c;
            color: #fff;
            margin-left: 6px;
        }
        .btn-hapus:hover {
            background: #c0392b;
        }

        /* Form Inline */
        form {
            display: inline;
        }
    </style>
</head>
<body>
    <h2>Daftar Pengguna</h2>

    <div style="margin-bottom: 15px;">
        <a href="{{ route('admin.dashboard') }}" class="btn-kembali">← Kembali ke Dashboard</a>
        <a href="{{ route('users.create') }}" class="btn-tambah">+ Tambah User</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada data pengguna</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
