<?php

namespace App\Http\Controllers;
class LoginController extends Controller
{
    public function create()
    {
        return view('/');
    }

    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->company_id == 0) {
                return route('admin.index');
            } elseif (auth()->user()->company_id != 0) {
                return route('driver.index');
            }
        } else
            return redirect()->to('userlogin');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
        if (auth()->user()->company_id == 0) {
            return redirect()->to('/admin')->with('warning', "Successfull");
        } elseif (auth()->user()->company_id != 0) {
            return redirect()->to('/driver')->with('warning', "Successfull");
        }
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
