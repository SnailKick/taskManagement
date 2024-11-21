<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected function validateUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }
}