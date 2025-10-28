<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;

class UserBorrowingController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $borrowings = Borrowing::with(['details.book']) // Ambil detail dan relasi ke book
        ->where('borrowing_user_id', $user->id)
        ->latest()
        ->get();

    return view('pages.student.borrowing', [
        'borrowings' => $borrowings,
        'user' => $user,
        'loggedIn' => Auth::check(),
        'menus' => [
            ['label' => 'Dashboard', 'href' => '/'],
            ['label' => 'Books', 'href' => '/student/books'],
            ['label' => 'Borrowings', 'href' => '/student/borrowing'],
        ],
    ]);
}


    public function cancelBorrowing(Borrowing $borrowing)
    {
        if ($borrowing->borrowing_user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Restore stock for each book in the borrowing details
        foreach ($borrowing->details as $detail) {
            $detail->book->increment('book_stock', $detail->detail_quantity);
        }

        // Delete borrowing details first
        $borrowing->details()->delete();

        // Delete the borrowing record
        $borrowing->delete();

        return back()->with('success', 'Peminjaman telah dibatalkan dan stok buku dikembalikan.');
    }

    public function markReturned(Borrowing $borrowing)
    {
        if ($borrowing->borrowing_user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Calculate fine if overdue
        $borrowingDate = \Carbon\Carbon::parse($borrowing->borrowing_date);
        $now = now();
        $weeksOverdue = floor($borrowingDate->diffInWeeks($now, false) - 1); // Subtract 1 week grace period
        $fine = max(0, $weeksOverdue * 500);

        $borrowing->update([
            'borrowing_isreturned' => true,
            'borrowing_fine' => $fine,
        ]);

        return back()->with('success', 'Peminjaman telah diselesaikan.' . ($fine > 0 ? ' Denda: Rp' . number_format($fine, 0, ',', '.') : ''));
    }
}
