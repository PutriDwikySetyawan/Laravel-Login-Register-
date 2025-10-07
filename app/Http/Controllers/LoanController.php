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

        if ($user && ($user->role === 'admin' || $user->role === 'guru')) {
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
            'return_date' => 'required|date|after:loan_date',
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
            'returned_at' => $request->return_date,
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

    // ✅ Tambahan: untuk mengembalikan buku
    public function returnBook($loanId)
    {
        $loan = Loan::findOrFail($loanId);

        // Pastikan hanya admin, guru, atau siswa yang meminjam buku tersebut yang bisa mengembalikan
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'guru']) && !($user->role === 'siswa' && $loan->user_id === $user->id)) {
            abort(403, 'Unauthorized');
        }

        // Pastikan status masih pinjam
        if ($loan->status !== 'pinjam') {
            return back()->withErrors(['loan' => 'Buku sudah dikembalikan sebelumnya.']);
        }

        // Update status dan tanggal pengembalian aktual
        $loan->update([
            'status' => 'kembali',
            'actual_returned_at' => now()->toDateString() // Tanggal pengembalian aktual
        ]);

        // Tambahkan stok buku kembali
        $loan->book->increment('stock');

        return back()->with('success', 'buku sudah di kembalikan');
    }
}
