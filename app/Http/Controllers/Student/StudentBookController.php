<?php



namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class StudentBookController extends Controller
{
    public function index()
    {
        return view('pages.student.index', [
            'books' => Book::with(['author', 'publisher', 'category', 'shelf'])->get(),
            'menus' => [
                ['label' => 'Dashboard', 'href' => '/'],
                ['label' => 'Books', 'href' => '/student/book'],
            ['label' => 'Borrowings', 'href' => '/student/borrowing'],

            ],
            'loggedIn' => Auth::check(),
            'user' => Auth::user(),
        ]);
    }
}



