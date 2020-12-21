<?php

namespace App\Models\Backend\Business;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Business extends Authenticatable
{
    use Notifiable;
    protected $table = 'business';
    protected $guard = 'business';

    protected $fillable = [
        'code_business',
        'name_company',
        'name_represent',
        'email',
        'password',
        'phone',
        'tax_code',
        'address',
        'image',
        'city',
        'district',
        'ward',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
