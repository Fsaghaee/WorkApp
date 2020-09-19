<?php

namespace App\Http\Controllers;

use App\Payslip;
use App\User;
use App\Driver;
use Illuminate\Http\Request;

class AdminDriversController extends Controller
{
    public function index()
    {
        //whithout ()
        if (auth()->user()) {
            if (auth()->user()->company_id == 0) {
                $drivers = User::all()->where('company_id', (auth()->user()->id));
                return view('Admin/AdminDrivers', compact('drivers'));
            } elseif (auth()->user()->company_id != 0) {
                return view('Driver/mainPage');
            }
        }
        return view('userLogin');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
            $this->validate(request(), [
                'name' => 'required',
                'family' => 'required',
                'address' => 'required',
                'tell' => 'required',
                'bank_account' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'insurance_number' => 'required',
                'birthday' => 'required'
            ]);
            $user = User::create(request(['name', 'family', 'email', 'address', 'tell', 'payment_method', 'bank_account', 'password', 'company_id','birthday','insurance_number']));
            return redirect()->to('admin-drivers');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
