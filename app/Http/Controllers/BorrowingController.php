<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use Illuminate\Support\Str;

class BorrowingController extends Controller
{
    public function borrowBook(Request $request, Book $book)
    {
        $user = Auth::user();

        // Cek stok
        if ($book->book_stock < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        // Buat record borrowings
        $borrowing = Borrowing::create([
            'borrowing_id' => Str::uuid(),
            'borrowing_user_id' => $user->id,
            'borrowing_isreturned' => false,
            'borrowing_notes' => null,
            'borrowing_fine' => 0,
            'borrowing_date' => now(),
        ]);

        // Buat record borrowing_details
        BorrowingDetail::create([
            'detail_id' => Str::uuid(),
            'detail_borrowing_id' => $borrowing->borrowing_id,
            'detail_book_id' => $book->book_id,
            'detail_quantity' => 1,
        ]);

        // Kurangi stok buku
        $book->decrement('book_stock');

        return back()->with('success', 'Buku berhasil dipinjam!');
    }
}
