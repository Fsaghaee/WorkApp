<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function drivers(){
        return $this->hasMany('App/Driver','company_id');
    }
    public function incomes(){
        return $this->hasMany('App/Incomes','company_id');
    }

    public function invoices(){
        return $this->hasMany('App/Invoice','company_id');
    }
}
