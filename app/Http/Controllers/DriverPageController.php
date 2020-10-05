<?php

namespace App\Http\Controllers;

use App\Payslip;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $lastwork = DB::table('works')->select('orders')->where('driver_id','=',auth()->user()->id)->orderBy('working_day', 'desc')->first();

        if (auth()->user()) {
            if (auth()->user()->company_id == 0) {
                return view('Admin/adminPage');
            } elseif (auth()->user()->company_id != 0) {
                $slips = Payslip::all()->where('driver_id', '=', auth()->user()->id);

                return view('Driver/mainPage', compact( 'slips','lastwork'));
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


        $validatedData = $request->validate([
            'working_day' => 'required',
            'orders' => 'required',
            'location' => 'required',
            'working_account' => 'required',
        ]);


        $user = User::findOrfail(auth()->user()->id);
        $work = new Work;
        $work->working_day = $request->working_day;
        $work->orders = $request->orders;
        $work->driver_id = $request->driver_id;
        $work->company_id = $request->company_id;
        $response = file_get_contents('http://api.weatherapi.com/v1/history.json?key=3fa2c903934841ed92885918201808&q=vienna&dt=' . $request->working_day);
        $response = json_decode($response, true);
        $work->wetter_temp = $response['forecast']['forecastday'][0]['day']['maxtemp_c'];
        $work->wetter_main = $response['forecast']['forecastday'][0]['day']['condition']['text'];
        $response['forecast']['forecastday'][0]['day']['condition']['icon'];
        $work->working_account = $request->working_account;
        $work->location = $request->location;
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
