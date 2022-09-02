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
 * @property string $address2
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bill[] $bills
 * @property-read int|null $bills_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @property-read int|null $files_count
 * @property-read string $fuel_name
 * @property-read string|int|bool $status_name
 * @property-read string $transmission_name
 * @property-read string|int|bool $type_name
 * @method static \Illuminate\Database\Eloquent\Builder|Car findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Car onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereAddress2($value)
 * @method static \Illuminate\Database\Query\Builder|Car withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Car withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Query\Builder|Car withoutTrashed()
 */
class Car extends Model
{
    use Sluggable;
    use HasFactory;
    use SoftDeletes;
    protected $fillable =  [
        'name',
        'image',
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

    public function getStatusNameAttribute(): bool|int|string
    {
        return CarStatusEnum::getKeyByValue($this->status);
    }

    public function getTypeNameAttribute(): bool|int|string
    {
        return CarTypeEnum::getKeyByValue($this->type);
    }
    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'table_id')
            ->where('files.table', FileTableEnum::getValue(strtoupper($this->getTable())));
    }

    public function getFuelNameAttribute(): string
    {
        $fuelName = '';
        if($this->fuel === 0){
            $fuelName = 'Xăng';
        }else if($this->fuel === 1) {
            $fuelName = 'Dầu';
        }
        return $fuelName;
    }
    public function getTransmissionNameAttribute(): string
    {
        $transmissionName = '';
        if($this->fuel === 0){
            $transmissionName = 'Số tự động';
        }else if($this->fuel === 1) {
            $transmissionName = 'Số sàn';
        }
        return $transmissionName;
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

}
