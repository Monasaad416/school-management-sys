<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Specialization;
use App\Models\Gender;
use App\Models\Section;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasTranslations;
use HasFactory;

public $translatable = ['name'];
protected $guarded = ['id', 'created_at', 'updated_at'];
public $timestamps = true;

public function specialization()
{
    return $this->belongsTo(Specialization::class,'specialization_id');
}
public function gender()
{
    return $this->belongsTo(Gender::class,'gender_id');
}

public function sections() {
    return $this->belongsToMany(Section::class)
    ->withTimeStamps();
}

}
