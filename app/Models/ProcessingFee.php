<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessingFee extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
