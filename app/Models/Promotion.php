<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }
    public function fromLevel()
    {
        return $this->belongsTo(Level::class, 'from_level');
    }
    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }
    public function toLevel()
    {
        return $this->belongsTo(Level::class, 'to_level');
    }
    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }
}
