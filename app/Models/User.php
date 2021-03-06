<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserDetails;
use App\UserTag;
use App\Models\Role;
use App\Models\Match;

class User extends Authenticatable
{
    use Notifiable, TransformableTrait;

    protected $with = ['details'];


    protected $appends = ['matched'];

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

    function model()
    {
        return "App\\User";
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function details()
    {
        return $this->hasOne(UserDetails::class);
    }

    public function tags()
    {
        return $this->hasMany(UserTag::class);
    }

    public function matches()
    {
        return $this->hasMany(Match::class);   
    }

    public function getMatchedAttribute()
    {
        return Match::where('user_id', \Auth::user()->id)->where('client_id', $this->id)->exists();

        return 0;
    }
}
