<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.user.home', [
            'user' => Auth::user(),
            'loggedIn' => Auth::check(),
            'menus' => [
                ['label' => 'Home', 'href' => '/student'],
                ['label' => 'Books', 'href' => '/student/books'],
                ['label' => 'Borrowing', 'href' => '/student/borrowing'],
            ],
        ]);
    }
}
