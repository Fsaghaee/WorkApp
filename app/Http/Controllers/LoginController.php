<?php

namespace App\Http\Controllers;


class LoginController extends Controller
{
    public function create()
    {
        return view('userLogin');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }

        return redirect()->to('/games');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('userLogin');
    }
}
