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
            'pay_order' => 'required',
            'birthday' => 'required',
            'register_date' => 'required'
        ]);
        $user = User::create(request(['name', 'family', 'email', 'address', 'tell', 'bank_account', 'password', 'company_id', 'birthday', 'insurance_number', 'pay_order', 'register_date']));
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

    }

    public function updateDriver(Request $request)
    {


        $this->validate(request(), [  'id' => 'required', ]);

        $user = User::findorfail($request->id);

        if (isset($request->pay_order)) {
            $user->pay_order = $request->pay_order;
        }
        if (isset($request->birthday)) {
            $user->birthday = $request->birthday;
        }
        if (isset($request->bank_account)) {
            $user->bank_account = $request->bank_account;
        }
        if (isset($request->tell)) {
            $user->tell = $request->tell;
        }
        if (isset($request->address)) {
            $user->address = $request->address;
        }
        if (isset($request->register_date)) {
            $user->register_date = $request->register_date;
        }
        if (isset($request->unregister_date)) {
            $user->unregister_date = $request->unregister_date;
        }

        $user->save();
        return redirect()->to('admin-drivers');


    }

    public function destroy($id)
    {
        //
    }
}
