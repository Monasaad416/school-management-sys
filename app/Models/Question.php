<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Quiz;

class Question extends Model
{
    use HasFactory;
    protected $guarded =['id','create_at','updated_at'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
