<?php

namespace App\Http\Controllers;

use App\Company;
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
        $company=Company::findorfail(auth()->user()->id );
         //whithout ()
        $drivers = $company->drivers;

        return view('Admin/AdminDrivers', compact('drivers'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    // we should complete all (some misses)
        $driver = new Driver();
        $driver->name = $request->name;
        $driver -> family= $request->family;
        $driver -> address= $request->address;
        $driver -> working_account= $request->working_account;
        $driver -> company_id= $request->company_id;

        $driver->save();
       // return $request->company_id;
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
