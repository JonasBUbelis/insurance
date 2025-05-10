<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    protected $fillable = ['name', 'surname', 'phone', 'email', 'address','user_id'];

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
