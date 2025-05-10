<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    protected $fillable = ['name', 'surname', 'phone', 'email', 'address'];

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
