<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Image;
use App\Models\Level;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Myparent;
use App\Models\Nationality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{

    use HasTranslations;
    use Notifiable;
    use HasFactory;
    use SoftDeletes;

    public $translatable = ['name'];
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function gender()
    {
        return $this->belongsTo(Gender::class,);
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
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function parent()
    {
        return $this->belongsTo(Myparent::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function studentAccount()
    {
        return $this->hasMany(StudentAccount::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)
        ->withPivot('result','time_mins','status')
        ->withTimeStamps();
    }
    public function nationamyparentlity()
    {
        return $this->belongsTo(Myparent::class);
    }

}
