<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function index () {
        return view('pages.auth.register');
    }

    public function action (RegisterRequest $request) {
        $data = array(
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        );
        $operation = User::create($data);

        if ($operation) {
            return redirect()->back()->with('success', 'Successfully register account!');
        } else {
            return redirect()->back()->with('error', 'Failed when register account!');
        }
    }
}
