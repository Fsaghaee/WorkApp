<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{




    public function drivers(){
        return $this->hasMany('App/Driver');
    }
    public function incomes(){
        return $this->hasMany('App/Incomes');
    }
    public function payslips(){
        return $this->hasMany('App/Payslip');
    }
    public function invoces(){
        return $this->hasMany('App/Invoice');
    }


}
