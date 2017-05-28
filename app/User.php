<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserDetails;
use App\UserTag;

class User extends Authenticatable
{
    use Notifiable;

    protected $with = ['details'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function details()
    {
        return $this->hasOne(UserDetails::class);
    }

    public function tags()
    {
        return $this->hasMany(UserTag::class);
    }   
}
