<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;
use voku\helper\ASCII;

class AdminPageController extends Controller
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
                $works = DB::table('works')
                    ->join('users', 'works.driver_id', '=', 'users.id')
                    ->select('works.*', 'users.name')
                    ->where('works.company_id', '=', auth()->user()->id)->where('working_day', '=', date('yy-m-d'))->get();
                $worksfirst = DB::table('works')->where('working_day', '>=', date('yy-m-01'))
                    ->where('working_day', '<=', date('yy-m-15'))->sum('orders');

                $workssecond = DB::table('works')->where('working_day', '>=', date('yy-m-16'))
                    ->where('working_day', '<=', date('yy-m-t'))->sum('orders');

                $worksLasrSecond = DB::table('works')->where('working_day', '>=', date('yy-m-16', strtotime("-1 month")))
                    ->where('working_day', '<=', date('yy-m-t', strtotime("-1 month")))->sum('orders');

                $worksLasrFirst = DB::table('works')->where('working_day', '>=', date('yy-m-01', strtotime("-1 month")))
                    ->where('working_day', '<=', date('yy-m-15', strtotime("-1 month")))->sum('orders');


                $klosSum = DB::table('works')->select('working_day', DB::raw('sum(orders) as total'))->where('location', '=', 'Klosterneuburg')->groupBy('working_day')->orderBy('working_day')->get();
                $WienSum = DB::table('works')->select('working_day', DB::raw('sum(orders) as total'))->where('location', '=', 'Wien')->groupBy('working_day')->orderBy('working_day')->get();;
                $TotalSum = DB::table('works')->select('working_day', DB::raw('sum(orders) as total'))->groupBy('working_day')->orderBy('working_day')->get();;

                $allDrivers = DB::table('users')->select('id', 'name','pay_order')->where('company_id', '=', auth()->user()->id)->get();
                $locations = DB::table('works')->select('location')->groupBy('location')->get();



                return view('Admin/adminPage', compact('works', 'klosSum', 'WienSum', 'worksfirst', 'worksLasrSecond', 'workssecond', 'worksLasrFirst', 'allDrivers', 'locations','TotalSum'));
            } elseif (auth()->user()->company_id != 0) {
                return view('Driver/mainPage');
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


    public function printearn($t1, $t2)
    {
        $worksLasrFirst = DB::table('works')->where('working_day', '>=', date($t1))
            ->where('working_day', '<=', date($t2))->sum('orders');

        return $worksLasrFirst;

    }

    public function getDriverWork(string $first, string $second, int $driver)
    {

        $worksLasrSecond = DB::table('works')->where('working_day', '>=', $first)
            ->where('working_day', '<=', $second)
            ->where('driver_id', '=', $driver)->sum('orders');

        return $worksLasrSecond;


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
