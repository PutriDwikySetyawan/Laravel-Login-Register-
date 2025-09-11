<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && $user->role === 'perpustakawan') {
            $loans = Loan::with(['user', 'book'])->latest()->paginate(15);
        } else {
            $loans = $user->loans()->with('book')->latest()->paginate(15);
        }

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('loans.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'    => 'required|exists:books,id',
            'loan_date'  => 'nullable|date', // tambahan validasi tanggal
            'user_id'    => 'nullable|exists:users,id'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $loanUserId = $request->user_id ?? $user->id;

        $book = Book::findOrFail($request->book_id);
        if ($book->stock < 1) {
            return back()->withErrors(['book_id' => 'Stok tidak cukup']);
        }

        // buat loan
        Loan::create([
            'user_id'   => $loanUserId,
            'book_id'   => $book->id,
            'loaned_at' => $request->loan_date ?? now()->toDateString(),
            'status'    => 'pinjam'
        ]);

        // kurangi stok
        $book->decrement('stock');

        return redirect()
            ->route('loans.index')
            ->with('success', 'Peminjaman dicatat berhasil.');
    }

    // ✅ Tambahan: untuk menampilkan riwayat peminjaman siswa
    public function history()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $loans = $user->loans()->with('book')->latest()->paginate(10);

        return view('loans.history', compact('loans'));
    }
}
