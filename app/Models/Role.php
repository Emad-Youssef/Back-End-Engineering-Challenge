<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
