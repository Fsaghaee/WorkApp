<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function works(){
        return $this->hasMany('App/Work','driver_id');
    }
    public function slips(){

        return $this->hasMany('App/Payslip','driver_id');
    }
}
