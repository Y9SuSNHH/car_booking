<?php

namespace App\Models;

use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

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
 * @method static create(array $array)
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
            ->whereIn('type', [
                FileTypeEnum::IDENTITY_FRONT,
                FileTypeEnum::IDENTITY_BACK,
            ])
            ->count();
        return $checkUserIdentity === 2;
    }

    public function checkUserLicenseCar($userId): bool
    {
        $checkUserLicenseCar = self::query()->where('table', FileTableEnum::USERS)
            ->where('table_id', $userId)
            ->whereIn('type', [
                FileTypeEnum::LICENSE_CAR_FRONT,
                FileTypeEnum::LICENSE_CAR_BACK,
            ])
            ->count();
        return $checkUserLicenseCar === 2;
    }

    public function updateOrCreate($table, $table_id, $type, $value): void
    {
        $file = self::query()->clone()
            ->where('table', $table)
            ->where('table_id', $table_id)
            ->where('type', $type)
            ->first();
        $link = Storage::disk('public')->putFile('users', $value);
        if ($file === null) {
            self::query()->create([
                'table'    => $table,
                'table_id' => $table_id,
                'type'     => $type,
                'link'     => $link,
            ]);
        } else {
            self::query()
                ->where('table', $table)
                ->where('table_id', $table_id)
                ->where('type', $type)
                ->update(['link' => $link]);
        }
    }
}
