<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
