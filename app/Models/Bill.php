<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable =  [
        "user_id",
        "car_id",
        "date_start",
        "date_end",
        "total_price",
        "status",
    ];
}
