<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'profile', "bio", 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getProfileAttribute($value)
    {
        // if ($value) {
        // return (asset('images/' . $value));
        // return (asset('images/download.jfif'));
        // } 
        // else {
        //     return (asset('/images/download.png'));
        // }
        return (asset($value ? 'images/' . $value  : 'images/download.jfif'));
    }
}
