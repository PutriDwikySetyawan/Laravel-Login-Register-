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
        $data = $request->validate([
            'title'     => ['required', 'string'],
            'author'    => ['nullable', 'string'],
            'publisher' => ['nullable', 'string'],
            'stock'     => ['required', 'integer', 'min:0'],
            'isbn'      => ['nullable', 'string'],
        ]);

        Book::create($data);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
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
        $data = $request->validate([
            'title' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $book->update($data);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
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
