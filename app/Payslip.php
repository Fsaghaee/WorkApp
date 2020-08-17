<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Payslip extends Model
{
    protected $fillable = [
        'status','driver_id','slip_file_location','company_id','due_date'
    ];
}
