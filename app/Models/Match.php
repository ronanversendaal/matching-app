<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable  = [
        'user_id', 'client_id'
    ];

    public function volunteer()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
