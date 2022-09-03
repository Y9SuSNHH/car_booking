<?php

namespace App\Models;

use App\Enums\Bill\BillStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory;
    use SoftDeletes;
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
            ->select('id', 'name', 'gender', 'phone', 'email');
    }

    public function staffStart(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_start', 'id')
            ->select('id', 'name', 'gender');
    }
    public function staffEnd(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_end', 'id')
            ->select('id', 'name', 'gender');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class)
            ->select('id', 'name');
    }

    public function getStatusNameAttribute(): bool|int|string
    {
        return BillStatusEnum::getKeyByValue($this->status);
    }
}
