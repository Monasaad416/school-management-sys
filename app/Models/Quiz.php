<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPUnit\Framework\MockObject\Builder\Stub;

class Quiz extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = ['id','created_at','updated_at'];
    public $translatable = ['name'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
        ->withPivot('result','time_mins','status')
        ->withTimeStamps();
    }

}
