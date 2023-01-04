<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{

    use HasTranslations;

    protected $table = 'levels';
    protected $fillable = ['name','grade_id'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}
