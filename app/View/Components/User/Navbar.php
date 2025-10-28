<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;


class Navbar extends Component
{
    public function render(): View|Closure|string
    {
        $loggedIn = Auth::check();
        $user = Auth::user();

        $menus = [];

        if ($loggedIn && $user) {
            if ($user->isadmin == 1) {
                $menus = [
                    ['label' => 'Dashboard', 'href' => '/admin'],
                    ['label' => 'Author', 'href' => '/admin/author'],
                    ['label' => 'Publisher', 'href' => '/admin/publisher'],
                    ['label' => 'Category', 'href' => '/admin/category'],
                    ['label' => 'Book', 'href' => '/admin/book'],
                    ['label' => 'Borrowing', 'href' => '/admin/borrowing'],
                ];
            } else {
                $menus = [
                    ['label' => 'Dashboard', 'href' => '/'],
                    ['label' => 'Book', 'href' => '/student/book'],
                    ['label' => 'Borrowing', 'href' => '/student/borrowing'],
                ];
            }
        }
        
        // else {
        //     $menus = [
        //         ['label' => 'Login', 'href' => '/login'],
        //     ];
        

        return view('components.user.navbar', [
            'loggedIn' => $loggedIn,
            'menus' => $menus,
            'user' => $user,
        ]);
    }
}
