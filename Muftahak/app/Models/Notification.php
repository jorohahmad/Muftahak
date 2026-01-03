<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notifications';
    protected $fillable = [
        'user_id',
        'rented_id',
        'type',
        'data',
        'read',
    ];
    public function rented(){
        return $this->belongsTo(Rented::class);
    }
}
