<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    protected $guarded = [];
}

