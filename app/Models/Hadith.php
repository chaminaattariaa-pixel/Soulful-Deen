<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
     protected $fillable = ['book','narrator','text_ar','text_en','text_ur','reference'];
}
