<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $apartment_id
 * @property string $first_date
 * @property string $last_date
 * @property string $location
 * @property string $id_credit_card
 * @property string $state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereFirstDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereIdCreditCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereLastDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserApartment whereUserId($value)
 * @mixin \Eloquent
 */
class UserApartment extends Model
{
    protected $table = 'user_apartment';

    protected $guarded = ['id'];
}
