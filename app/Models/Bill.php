<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "car_id",
        "date_start",
        "date_end",
        "total_price",
        "status",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->select([
                'name',
                'phone',
                'email',
                'gender',
                'address',
                'address2',
            ]);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
