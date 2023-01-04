<?php

namespace App\Models;

use App\Models\Fee;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
