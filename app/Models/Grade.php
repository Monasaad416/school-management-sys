<?php
namespace App\Models;

use App\Models\Level;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;


    protected $table = 'grades';
    protected $fillable = ['name','notes'];
    public $translatable = ['name'];
    public $timestamps = true;


        public function levels()
    {
        return $this->hasMany(Level::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}
