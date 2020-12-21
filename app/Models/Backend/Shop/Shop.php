<?php

namespace App\Models\Backend\Shop;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shop extends Authenticatable
{
    use Notifiable;
    protected $guard = 'shops';

    protected $fillable = [
        'code_shop',
        'name_shop',
        'name',
        'email',
        'phone',
        'password',
        'address',
        'image',
        'city',
        'district',
        'ward'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
