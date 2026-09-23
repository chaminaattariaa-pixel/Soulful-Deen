<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuranVerse extends Model
{
     protected $fillable = ['surah','ayah','arabic_text','translation_en','translation_ur','tafsir'];
}
