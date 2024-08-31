<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'departments',
        'position',
        'date_of_birth',
        'gender',
        'hire_date',
        'salary',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->hasMany(Department::class);
    }
    public function documents(){
        return $this->hasMany(Documents::class);
    }
}
