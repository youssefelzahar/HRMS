<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequests extends Model
{
    use HasFactory;
    protected $fillable=['employee_id',"start_date","end_date","reason","status","leave_typess_id"];
     public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
