<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable=['employee_id','date','check_in_time','check_out_time','status'];

    public function user(){

        return $this->belongsTo(User::class,'employee_id');}

}
