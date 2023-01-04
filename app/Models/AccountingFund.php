<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AccountingFund extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

}
