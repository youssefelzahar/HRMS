<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $connection = 'tenant';

    protected $fillable = [
        'user_id',
        'departments',
        'position',
        'date_of_birth',
        'gender',
        'hire_date',
        'salary',
        'status',
        'version'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'departments');
    }

    public function documents(){
        return $this->hasMany(Documents::class);
    }
}
