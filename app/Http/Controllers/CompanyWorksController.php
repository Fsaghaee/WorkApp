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

        $worksfirst = DB::table('works')->where('working_day', '>=', date('yy-m-01'))
            ->where('working_day', '<=', date('yy-m-15'))->sum('orders');

        $workssecond = DB::table('works')->where('working_day', '>=', date('yy-m-16'))
            ->where('working_day', '<=', date('yy-m-t'))->sum('orders');

        $worksLasrSecond = DB::table('works')->where('working_day', '>=', date('yy-m-16', strtotime("-1 month")))
            ->where('working_day', '<=', date('yy-m-t', strtotime("-1 month")))->sum('orders');


        $allDrivers = DB::table('works')->select('driver_id')->distinct()->get();


        return view('Admin/CompanyWorks', compact('allworks', 'worksfirst', 'workssecond', 'worksLasrSecond','allDrivers'));
    }


    public function getDriverWork(string $first, string $second, int $driver)
    {

        $worksLasrSecond = DB::table('works')->where('working_day', '>=', $first)
            ->join('users', 'works.driver_id', '=', 'users.id')->select('name')
            ->where('working_day', '<=', $second)
            ->where('driver_id', '=', $driver)->sum('orders');
        return '<br><h5>' . $this->getDriverName($driver) . ' : ' . $worksLasrSecond . '  </h5><br>';
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
        //
    }
}
