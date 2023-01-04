<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Exam extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = ['id','created_at','updated_at'];
    public $translatable = ['name'];

}


