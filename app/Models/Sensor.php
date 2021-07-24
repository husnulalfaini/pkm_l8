<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    protected $table = 'sensors';
    protected $fillable = [
       'berat1','berat2','berat3','berat4','totalberat','ultrasonik','kondisi',
    ];
}
