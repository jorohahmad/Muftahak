<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $rented_id
 * @property string $title
 * @property string $governorate
 * @property string $city
 * @property int $price
 * @property string $description
 * @property string $details
 * @property string $status
 * @property string|null $image1
 * @property string|null $image2
 * @property string|null $image3
 * @property string|null $image4
 * @property string|null $image5
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $favoriateByUser
 * @property-read int|null $favoriate_by_user_count
 * @property-read \App\Models\Rented $rented
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ApartmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereGovernorate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereImage3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereImage4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereImage5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereRentedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Apartment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Apartment extends Model
{
    use HasFactory;
    protected $table = 'apartments';
    protected $guarded = ['id'];

    function rented() {
        return $this->belongsTo(Rented::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'user_apartment');
    }
     public function favoriateByUser(){
        return $this->belongsToMany(User::class,'favorites');
    }
     public function rateByUser(){
        return $this->belongsToMany(User::class,'rates');
    }
}
