<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class CompanyWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allworks = DB::table('works')
            ->join('users', 'works.driver_id', '=', 'users.id')
            ->select('works.*', 'users.name')->orderBy('works.working_day', 'desc')
            ->where('works.company_id', '=', auth()->user()->id)->get();

       // $worksfirst = DB::table('works')->where('working_day', '>=', date('yy-m-01'))
         //   ->where('working_day', '<=', date('yy-m-15'))->sum('orders');

      //  $workssecond = DB::table('works')->where('working_day', '>=', date('yy-m-16'))
    //        ->where('working_day', '<=', date('yy-m-t'))->sum('orders');

  //      $worksLasrSecond = DB::table('works')->where('working_day', '>=', date('yy-m-16', strtotime("-1 month")))
//            ->where('working_day', '<=', date('yy-m-t', strtotime("-1 month")))->sum('orders');


     //

        $klosSum = DB::table('works')->select('working_day', DB::raw('sum(orders) as total'))->where('location', '=', 'Klosterneuburg')->groupBy('working_day')->orderBy('working_day', 'desc')->get();
        $WienSum = DB::table('works')->select('working_day', DB::raw('sum(orders) as total'))->where('location', '=', 'Wien')->groupBy('working_day')->orderBy('working_day', 'desc')->get();;

        $avgKlos = DB::table(function ($query) {
            $query->selectRaw('working_day,sum(orders) as total')
                ->from('works')->where('location', '=', 'Klosterneuburg')
                ->groupBy('working_day')->orderBy('working_day', 'desc');
        })
            ->selectraw(' DAYNAME(working_day) as day , AVG(total) as av ')
            ->groupBy('day')->orderBy('day')->get();


        $avgWien = DB::table(function ($query) {
            $query->selectRaw('working_day,sum(orders) as total')
                ->from('works')->where('location', '=', 'Wien')
                ->groupBy('working_day')->orderBy('working_day', 'desc');
        })
            ->selectraw(' DAYNAME(working_day) as day , AVG(total) as av ')
            ->groupBy('day')->get();


        return view('Admin/CompanyWorks', compact('allworks','klosSum', 'WienSum', 'avgKlos', 'avgWien'));
    }


    public function getDriverWork(string $first, string $second, int $driver)
    {

        $worksLasrSecond = DB::table('works')->where('working_day', '>=', $first)
            ->join('users', 'works.driver_id', '=', 'users.id')->select('name')
            ->where('working_day', '<=', $second)
            ->where('driver_id', '=', $driver)->sum('orders');

            return  $worksLasrSecond ;


    }



    public function getaccountrWork(string $first, string $second)
    {

        $locations = $this->getallLocations();

        foreach ($locations as $location) {

            echo '<div style="padding: 10px;">';
            $worksLasrSecond = DB::table('works')->select('working_account', DB::raw('sum(orders) as total'))->where('working_day', '>=', $first)
                ->where('working_day', '<=', $second)->where('location', '=', $location->location)->groupBy('working_account')->get();
            $sum = 0;
            echo '<h3  style="text-align: center;color: white;">' . $location->location . '</h3><br>';
            foreach ($worksLasrSecond as $a) {
                echo '<h4  style="text-align: center;color: black;">' . $a->working_account . ' : ' . $a->total . '</h4>';
                $sum += $a->total;
                echo '<br>';

            }
            echo '<h2 style="text-align: center;color: red;">'.$sum.'</h2></div>';
        }


    }


    function getallLocations()
    {
        return $locations = DB::table('works')->select('location')->groupBy('location')->get();
    }

    function getDriverName(int $id)
    {

        return $name = DB::table('users')->select('name')->where('id', '=', $id)->first()->name;


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
        //
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
        $work = Work::find($id);
        $work->delete();
        return redirect()->to('/company-works');

    }
}
