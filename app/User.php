<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


    protected $fillable = [
        'name', 'family', 'bank_account', 'address', 'tell', 'email', 'password', 'company_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    public function works()
    {
        return $this->hasMany('App\Work', 'driver_id');
    }


    public function slips()
    {

        return $this->hasMany('App\Payslip', 'driver_id');
    }


    public function incomes()
    {
        return $this->hasMany('App\Incomes', 'company_id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'company_id');
    }
}
