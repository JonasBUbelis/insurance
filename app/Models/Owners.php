<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Owners extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'phone', 'email', 'address', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
