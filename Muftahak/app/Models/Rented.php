<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $firstName
 * @property string|null $lastName
 * @property string|null $birthday
 * @property string $phoneNumber
 * @property string|null $personalImage
 * @property string|null $personalIdImage
 * @property string $role
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Apartment> $apartments
 * @property-read int|null $apartments_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\RentedFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented wherePersonalIdImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented wherePersonalImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rented whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rented extends Authenticatable
{   
    use Notifiable,HasApiTokens,HasFactory;
    protected $table='renteds';
    protected $fillable=[
        'firstName',
        'lastName',
        'birthday',
        'phoneNumber',
        'password',
        'personalIdImage',
        'personalImage'
    ];

    function apartments() {
        return $this->hasMany(Apartment::class);
    }
   public function notifications(){
        return $this->hasMany(Notification::class,'rented_id');
    }
}
