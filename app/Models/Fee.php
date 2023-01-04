<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use hasTranslations;
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    public $translatable = ['title'];


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
