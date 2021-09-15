<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'land_mark',
        'flat_no',
        'address',
        'avatar',
        'provider',
        'provider_id',
        'access_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //ALTER TABLE `users` ADD `avatar` VARCHAR(255) NULL DEFAULT NULL AFTER `password`, ADD `provider` VARCHAR(255) NULL DEFAULT NULL AFTER `avatar`, ADD `provider_id` VARCHAR(255) NULL DEFAULT NULL AFTER `provider`, ADD `access_token` VARCHAR(255) NULL DEFAULT NULL AFTER `provider_id`;
}
