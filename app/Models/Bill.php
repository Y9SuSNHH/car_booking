<?php

namespace App\Models;

use App\Enums\BillStatusEnum;
use App\Enums\FileTableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Bill
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $staff_start
 * @property int|null $staff_end
 * @property int $car_id
 * @property string $date_start
 * @property string $date_end
 * @property string|null $date_real_end
 * @property string $total_price
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Car $car
 * @property-read string|int|bool $status_name
 * @property-read \App\Models\User|null $staffEnd
 * @property-read \App\Models\User|null $staffStart
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\BillFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill newQuery()
 * @method static \Illuminate\Database\Query\Builder|Bill onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDateRealEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereStaffEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereStaffStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bill whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Bill withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Bill withoutTrashed()
 * @method static create(array $array)
 * @mixin \Eloquent
 * @property-read int $generate_status
 */
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
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'id', 'table_id')
            ->where('table', FileTableEnum::BILLS);
    }

    public function staffStart(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_start', 'id');
    }

    public function staffEnd(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_end', 'id');
    }


    public function getStatusNameAttribute(): bool|int|string
    {
        return BillStatusEnum::getValueByKey($this->status);
    }

    public function getGenerateStatusAttribute(): string
    {
        $date_end = strtotime($this->date_end);
        $now      = strtotime(now());
        $diff     = $now - $date_end;
        $diff     = floor($diff / (60 * 60 * 24));

        $status = $this->status;
        if ($diff > 0 && $status === BillStatusEnum::ACCEPTED) {
            $status = BillStatusEnum::EXPIRES;
        }

        $statusIcon = '';

        if ($status === BillStatusEnum::PENDING) {
            $statusIcon = 'primary';
        }
        if ($status === BillStatusEnum::ACCEPTED) {
            $statusIcon = 'warning';
        }
        if ($status === BillStatusEnum::DONE) {
            $statusIcon = 'success';
        }
        if ($status === BillStatusEnum::EXPIRES) {
            $statusIcon = 'danger';
        }
        return $statusIcon;
    }
}
