<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    protected $fillable=["employee_id","document_type","file_path","uploaded_at"];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
}
