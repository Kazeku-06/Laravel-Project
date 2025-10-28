<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'details.book'])->latest()->get();

        return view('pages.admin.borrowing', compact('borrowings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'borrowing_fine' => 'nullable|numeric|min:0',
            'borrowing_notes' => 'nullable|string|max:255',
        ]);

        $borrowing = Borrowing::findOrFail($id);
        $borrowing->borrowing_fine = $request->borrowing_fine;
        $borrowing->borrowing_notes = $request->borrowing_notes;
        $borrowing->save();

        return redirect()->route('admin.borrowings.index')->with('success', 'Data peminjaman diperbarui.');
    }
}

