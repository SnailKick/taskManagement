<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $avatarName = $user->id . '_avatar.' . $request->avatar->extension();
        $request->avatar->storeAs('public/avatars', $avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Аватар успешно обновлен.');
    }
}