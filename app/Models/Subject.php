<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name','grade_id','level_id','teacher_id'];
    public $translatable = ['name'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

