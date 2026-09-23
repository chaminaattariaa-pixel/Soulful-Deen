<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ayat extends Model
{
    
    protected $table = 'ayat_of_day';       
    protected $fillable = ['arabic', 'urdu', 'english', 'reference'];
    
}
