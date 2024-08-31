<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTrainings extends Model
{
    use HasFactory;
    protected $fillable=['employee_id','training_sessions_id','status'];

    public function trainingSessions()
    {
        return $this->belongsTo(TrainingSessions::class,'training_sessions_id');
    }
}
