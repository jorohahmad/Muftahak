<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rented extends Authenticatable
{
    use Notifiable,HasApiTokens;
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
}
