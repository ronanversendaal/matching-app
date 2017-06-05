<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\User;

class Role extends Model
{

    function model()
    {
        return "App\\Models\\Role";
    }

    public function users()
    {
      return $this
        ->belongsToMany(User::class)
        ->withTimestamps();
    }
}
