<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'data',
        'read',
        'rented_id'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function rented()
    {
        return $this->belongsTo(Rented::class);
    }
}
