<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserDetails extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bio', 'profile', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }   
}
