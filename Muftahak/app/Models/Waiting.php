<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_id
 * @property string $apartment_id
 * @property string $rented_id
 * @property string $first_date
 * @property string $last_date
 * @property string $location
 * @property string $id_credit_card
 * @property string $state
 * @property string $confirmed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereApartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereFirstDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereIdCreditCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereLastDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereRentedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Waiting whereUserId($value)
 * @mixin \Eloquent
 */
class Waiting extends Model
{
    protected $table = 'waitings';

    protected $guarded = ['id'];
}
