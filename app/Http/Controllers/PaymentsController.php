<?php

namespace App\Http\Controllers;

use App\Payslip;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //  $payslips = Payslip::all()->where('company_id', '=', auth()->user()->id);
        $payslips = DB::table('payslips')
            ->join('users', 'payslips.driver_id', '=', 'users.id')
            ->select('payslips.*', 'users.name')
            ->where('payslips.company_id', '=', auth()->user()->id)->get();
        $drivers = User::all()->where('company_id', (auth()->user()->id));

        return view('Admin/PaySlips', compact('payslips','drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = $request->driver_id . '_' . $request->monat . '.' . $file->getClientOriginalExtension();
        $file->move('payslips', $name);
        $payslip = new Payslip(['due_date' => $request->due_date, 'status' => 'payed', 'slip_file_location' => 'payslips/' . $name, 'driver_id' => $request->driver_id, 'company_id' => auth()->user()->id]);
        $payslip->save();
        return redirect()->to('payments');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payslip = Payslip::find($id);
        $payslip->delete();

        return redirect()->to('/payments');
    }
}
