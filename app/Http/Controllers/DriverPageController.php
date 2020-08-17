<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;

class DriverPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->company_id == 0) {
                return view('Admin/adminPage');

            } elseif (auth()->user()->company_id != 0) {
                $works = Work::all()->where('driver_id', auth()->user()->id);

                return view('Driver/mainPage', compact('works'));

            }
        }
        return view('userLogin');


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
        $user = User::findOrfail(auth()->user()->id);
        $work = new Work;
        $work->working_day = $request->working_day;
        $work->orders = $request->orders;
        $work->driver_id = $request->driver_id;
        $work->company_id = $request->company_id;
        $work->wetter_temp = $request->wetter_temp;
        $work->wetter_main   = $request->wetter_main;
        $work->break = $request->break;
        $work->working_account = $request->working_account;
        $work->start_working = $request->start_working;
        $work->end_working=$request->end_working;
        $work->location=$request->location;

        $user->works()->save($work);
        return redirect()->to('/driver');
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
        //
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
        //
    }
}
