<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Tampilkan daftar buku.
     */
    public function index()
    {
        $books = Book::orderBy('title')->paginate(12);

        return view('books.index', compact('books'));
    }

    /**
     * Form tambah buku baru.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Simpan buku baru.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title'   => 'required|string|max:255',
        'author'  => 'required|string|max:255',
        'category'=> 'required|string|max:255',
        'year'    => 'required|integer',
        'stock'   => 'required|integer',
        'cover'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi cover
    ]);

    // Simpan file cover jika ada
    if ($request->hasFile('cover')) {
        $path = $request->file('cover')->store('covers', 'public'); 
        $validated['cover'] = $path;  // masukkan path ke array validated
    }

    Book::create($validated);

    return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
}

    /**
     * Form edit buku.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update data buku.
     */
    public function update(Request $request, Book $book)
{
    $validated = $request->validate([
        'title'   => 'required|string|max:255',
        'author'  => 'required|string|max:255',
        'category'=> 'required|string|max:255',
        'year'    => 'required|integer',
        'stock'   => 'required|integer',
        'cover'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('cover')) {
        $path = $request->file('cover')->store('covers', 'public');
        $validated['cover'] = $path;
    }

    $book->update($validated);

    return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate!');
}


    /**
     * Hapus buku.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Buku berhasil dihapus.');
    }
}
