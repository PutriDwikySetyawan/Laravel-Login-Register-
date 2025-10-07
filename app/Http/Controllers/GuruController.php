<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ tambah ini
use App\Models\Loan;

class GuruController extends Controller
{
    public function index()
    {
        return view('dashboard.guru');
    }

    public function history()
    {
        // Pakai Auth::id() agar lebih jelas
        $loans = Loan::where('user_id', Auth::id())
                     ->latest()
                     ->get();

        return view('loans.history', compact('loans'));
    }
}
