<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    protected $table = 'sections';
    protected $fillable = ['name','status','grade_id','level_id'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class)
        ->withTimeStamps();
    }





}
