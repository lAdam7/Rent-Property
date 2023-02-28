<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.create');
    }

    public function store()
    {
        $attributes = $this->validateLogin();

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages(['email' => "Your provided credentials cannot be verified"]);
        }

        session(['topBar' => true]);
        session()->regenerate(); // new token (safety)
        return redirect('/')->with('success', 'Weclome back, ' . auth()->user()->forename . '!');
    }

    protected function validateLogin(): array
    {
        return request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }
}
