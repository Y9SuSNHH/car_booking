<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable =  [
        'name', 
        'image', 
        'brand', 
        'address',
        'type', 
        'slot', 
        'transmission',
        'fuel',
        'fuel_comsumpiton',
        'description',
        'price_1_day',
        'price_insure',
        'price_service',
        'status',
        'slug',
    ];
}
