<?php

namespace App\Models;

use App\Enums\FileStatusEnum;
use App\Enums\FileTableEnum;
use App\Enums\FileTypeEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property int|null $gender
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $email
 * @property string|null $username
 * @property string|null $password
 * @property int $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 * @property string|null $address2
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @property-read int|null $files_count
 * @property-read string $gender_name
 * @property-read string|int|bool $role_name
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @method static create(array $array)
 */
class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'address2',
        'address',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getRoleNameAttribute(): bool|int|string
    {
        return UserRoleEnum::getValueByKey($this->role);
    }

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 1) ? 'Nam' : 'Nữ';
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'table_id')
            ->where('files.table', FileTableEnum::getValue(strtoupper($this->getTable())));
    }

    public function getFileIdentityAttribute(): string
    {
        $status = 0;
        foreach ($this->files as $file) {
            if ($file->type === FileTypeEnum::IDENTITY_FRONT || $file->type === FileTypeEnum::IDENTITY_BACK) {
                if ($file->status === FileStatusEnum::APPROVED) {
                    ++$status;
                }
                if ($file->status === FileStatusEnum::PENDING) {
                    --$status;
                }
            }
        }
        if ($status === 2) {
            return 'success';
        }
        if ($status === -2) {
            return 'warning';
        }
        return 'danger';
    }

    public function getFileLicenseCarAttribute(): string
    {
        $status = 0;
        foreach ($this->files as $file) {
            if ($file->type === FileTypeEnum::LICENSE_CAR_FRONT || $file->type === FileTypeEnum::LICENSE_CAR_BACK) {
                if ($file->status === FileStatusEnum::APPROVED) {
                    ++$status;
                }
                if ($file->status === FileStatusEnum::PENDING) {
                    --$status;
                }
            }
        }
        if ($status === 2) {
            return 'success';
        }
        if ($status === -2) {
            return 'warning';
        }
        return 'danger';
    }
}
