<?php

namespace App\Models;

use App\Enums\FileTableEnum;
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
        return UserRoleEnum::getKeyByValue($this->role);
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
}
