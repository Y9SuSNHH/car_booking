<?php

namespace App\Models;

use App\Enums\CarStatusEnum;
use App\Enums\CarTypeEnum;
use App\Enums\FileTableEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $brand
 * @property string $address
 * @property int $type
 * @property int $slot
 * @property int $transmission
 * @property int $fuel
 * @property int $fuel_comsumpiton
 * @property string $description
 * @property float $price_1_day
 * @property float $price_insure
 * @property float $price_service
 * @property int $status
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\CarFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereFuelComsumpiton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePrice1Day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePriceInsure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePriceService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Car extends Model
{
    use Sluggable;
    use HasFactory;
    use SoftDeletes;
    protected $fillable =  [
        'name',
        'image',
        'fullphoto',
        'address',
        'address2',
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
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getStatusNameAttribute()
    {
        return CarStatusEnum::getKeyByValue($this->status);
    }

    public function getTypeNameAttribute()
    {
        return CarTypeEnum::getKeyByValue($this->type);
    }
    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'table_id')
            ->where('files.table', FileTableEnum::getValue(strtoupper($this->getTable())));
    }
}
