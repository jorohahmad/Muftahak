<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $table = 'apartments';
    protected $guarded = ['id'];

    function rented() {
        return $this->belongsTo(Rented::class);
    }
}
