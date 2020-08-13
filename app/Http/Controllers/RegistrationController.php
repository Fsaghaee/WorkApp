<?php

namespace App\Http\Controllers;
use App\Company;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('firstPage');
    }


    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'family' => 'required',
            'address' => 'required',
            'tell' => 'required',
            'bank_account' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Company::create(request(['name', 'email','address','tell','family','bank_account', 'password']));

       //7 auth()->login($user);

        return redirect()->to('/games');
    }



}
