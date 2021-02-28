<?php

namespace App\Http\Controllers;
class LoginController extends Controller
{
    public function create()
    {
        return view('/');
    }

    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->company_id == 0) {

                return route('admin.index');
            } elseif (auth()->user()->company_id != 0 && auth()->user()->unregister_date == "") {

                return route('driver.index');


            } elseif (auth()->user()->company_id != 0 && auth()->user()->unregister_date < date('Y-m-d', strtotime(now() . ' -5 day'))) {

                return redirect()->to('logout');


            }

        } else
            return redirect()->to('logout');
    }

    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
        if (auth()->user()->company_id == 0 ) {

            return redirect()->to('/admin')->with('warning', "Successfull");
        } elseif (auth()->user()->company_id != 0 && auth()->user()->unregister_date == "") {
            return redirect()->to('/driver')->with('warning', "Successfull");
        }elseif (auth()->user()->company_id != 0 && auth()->user()->unregister_date > date('Y-m-d', strtotime(now() . ' -5 day'))) {

            return redirect()->to('/driver')->with('warning', "Successfull");
        }else{
            return redirect()->to('logout')->with('warning', "Unregistered");
        }
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
