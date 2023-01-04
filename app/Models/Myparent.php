<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Myparent extends Authenticatable
{
    use HasTranslations;

    protected $guarded = ['id','created_at','updated_at'];
    public $translatable = ['father_name','father_job','mother_name','mother_job'];
    protected $table = 'myparents';
    use HasFactory;

}
