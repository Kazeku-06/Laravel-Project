<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Shelf;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // READ: Tampilkan semua buku
    public function index()
    {
        $books = Book::getAllBooks(5);
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        $shelves = Shelf::all();

        return view('pages.admin.book', compact('books', 'authors', 'categories', 'publishers', 'shelves'));
    }

    // READ: Tampilkan form tambah buku
    public function create()
    {
        return view('pages.admin.book.create', [
            'authors' => Author::all(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'shelves' => Shelf::all(),
        ]);
    }

    // CREATE: Simpan buku baru
  public function store(BookRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('book_img')) {
        $data['book_img'] = $request->file('book_img')->store('books', 'public');
    }

    Book::create($data);

    return redirect('/admin/book')->with('success', 'Book created successfully.');
}
    // READ: Tampilkan detail buku untuk edit
    public function edit(Book $book)
    {
        return view('pages.admin.book.edit', [
            'book' => $book,
            'authors' => Author::all(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'shelves' => Shelf::all(),
        ]);
    }

    // UPDATE: Update buku
    public function update(BookRequest $request, Book $book)
{
    $data = $request->validated();

    if ($request->hasFile('book_img')) {
        if ($book->book_img && Storage::disk('public')->exists($book->book_img)) {
            Storage::disk('public')->delete($book->book_img);
        }
        $data['book_img'] = $request->file('book_img')->store('books', 'public');
    }

    $book->update($data);

    return redirect('/admin/book')->with('success', 'Book updated successfully.');
}
}
