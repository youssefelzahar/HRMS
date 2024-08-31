<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaries extends Model
{
    use HasFactory;
    protected $fillable=['employee_id','amount','effective_date'];

    public function employee()
    {
        return $this->belongsTo(Employees::class,'employee_id');
    }
}
