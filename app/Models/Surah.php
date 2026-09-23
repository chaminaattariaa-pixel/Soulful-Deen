<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    protected $fillable = [
        'surah_number',
        'name',
        'english_name',
        'number_of_ayahs',
        'revelation_type',
    ];
    
    public function ayahs()
    {
        return $this->hasMany(Ayah::class);
    }
}