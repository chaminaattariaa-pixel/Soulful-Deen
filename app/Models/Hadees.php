<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hadees extends Model
{
    protected $table = 'hadees_of_day';

    protected $fillable = [
        'arabic',
        'urdu',
        'english',
        'reference',
    ];
}
