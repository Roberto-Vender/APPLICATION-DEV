<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'display_name',
        'email',
        'password',
        'total_points',
        'riddle_points',
        'logic_points',
        'endurance_points',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
