<?php

namespace App\Models;

use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int $table
 * @property int $table_id
 * @property int $type
 * @property string $link
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'table',
        'table_id',
        'type',
        'link',
    ];

//    public function cars(): HasMany
//    {
//        return $this->hasMany(Car::class, 'table_id')
//            ->where('files.table', strtoupper(FileTableEnum::getKey(FileTableEnum::CARS)));
//    }

    public function checkUserIdentity($userId): bool
    {
        $checkUserIdentity = self::query()->where('table', FileTableEnum::USERS)
            ->where('table_id', $userId)
            ->where('type', FileTypeEnum::IDENTITY)
            ->count();
        return $checkUserIdentity === 2;
    }

    public function checkUserLicenseCar($userId): bool
    {
        $checkUserLicenseCar = self::query()->where('table', FileTableEnum::USERS)
            ->where('table_id', $userId)
            ->where('type', FileTypeEnum::LICENSE_CAR)
            ->count();
        return $checkUserLicenseCar === 2;
    }
}
