<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $fillable = [
        'user_id',
        'rented_id',
        'type',
        'data',
        'read'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
