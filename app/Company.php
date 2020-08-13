<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{


    protected $fillable = [
        'name','family','bank_account','address','tell', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    public function drivers(){
        return $this->hasMany('App\Driver','company_id');
    }
    public function incomes(){
        return $this->hasMany('App\Incomes','company_id');
    }

    public function invoices(){
        return $this->hasMany('App\Invoice','company_id');
    }
}
