<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileImageRequest;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil user berdasarkan ID
        return view('pages.user.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:150',
            'lastname' => 'required|string|max:150',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Biodata berhasil diperbarui.');
    }


        public function updateProfileImage (ProfileImageRequest $request) {
    $profileImagePath = $request->file('profileimg')->store('profile_images', 'public');
    $data = array(
        'profileimg' => $profileImagePath
    );

    $operation = User::updateProfileImageById(Auth::user()->id, $data);

    if ($operation) {
        Log::info('User ' . Auth::user()->firstname . ' ' . Auth::user()->lastname . ' mengupdate Profile Image.');
        return redirect()->back()->with('success', 'Successfully update profile image!');
    } else {
        return redirect()->back()->with('success', 'Failed to update profile image!');
    }
}


    


    
}

