<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    protected $fillable = [
        'surah_id',        // Change from surah_number to surah_id
        'ayah_number',
        'arabic_text',
        'urdu_text',
        'english_text',
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
    
    // Add accessor to get surah_number for backward compatibility
    public function getSurahNumberAttribute()
    {
        return $this->surah ? $this->surah->surah_number : null;
    }
}