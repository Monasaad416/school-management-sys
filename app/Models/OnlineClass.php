<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineClass extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];


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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
