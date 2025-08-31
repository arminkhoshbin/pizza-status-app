<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController
{
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('pos.send-update.create');
        }

        return Inertia::render('Auth/Login');
    }

    public function store(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            return to_route('pos.send-update.create');
        }

        return to_route('login')->withErrors([
            'emailPassword' => 'Email address or password is incorrect.'
        ]);
    }
}