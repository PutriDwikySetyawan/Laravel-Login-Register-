<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class DashboardController extends Controller
{
    /**
     * Redirect sesuai role.
     */
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            default => redirect()->route('siswa.dashboard'),
        };
    }

    /**
     * Dashboard Admin.
     */
    public function admin()
    {
        return view('dashboard.admin');
    }

    /**
     * Dashboard Guru.
     */
    public function guru()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('dashboard.guru', compact('books'));
    }

    /**
     * Dashboard Siswa.
     */
    public function siswa()
    {
        $books = Book::where('stock', '>', 0)->get();
        $user = Auth::user();
        $currentLoans = \App\Models\Loan::where('user_id', $user->id)->where('status', 'pinjam')->with('book')->get();
        return view('dashboard.siswa', compact('books', 'currentLoans'));
    }
}
