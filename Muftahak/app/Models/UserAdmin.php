<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $firstName
 * @property string|null $lastName
 * @property string|null $birthday
 * @property string $phoneNumber
 * @property string|null $personalImage
 * @property string|null $personalIdImage
 * @property string $role
 * @property string $boolean
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin wherePersonalIdImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin wherePersonalImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserAdmin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserAdmin extends Model
{
    protected $table='user_admins';
    protected $fillable = [
        'firstName',
        'lastName',
        'birthday',
        'phoneNumber',
        'password',
        'personalIdImage',
        'personalImage',
        'role',
        'boolean'
    ];
}
