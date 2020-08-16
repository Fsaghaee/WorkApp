<?php

namespace App\Http\Controllers;

use App\User;
use App\Driver;
use Illuminate\Http\Request;

class AdminDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $company=User::findorfail(auth()->user()->id );
         //whithout ()
        if(auth()->user()){
            if(auth()->user()->company_id == 0){
                $drivers = User::all()->where('company_id',(auth()->user()->id ));

                return view('Admin/AdminDrivers', compact('drivers'));
            }elseif(auth()->user()-company_id != 0){
                return 'driver Page';

            }}
        return view('userLogin');


     //   return view('Admin/AdminDrivers');

    }


    public function create()
    {
        //
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
            'password' => 'required'
        ]);

        $user = User::create(request(['name','family', 'email','address','tell','working_account','bank_account', 'password','company_id']));

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
