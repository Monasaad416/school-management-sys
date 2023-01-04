<?php

namespace App\Models;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Admin extends Authenticatable
{
    use HasFactory,HasTranslations;

    protected $guarded = ['id','created_at','updated_at'];
    public $translatable = ['name'];


    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
}
