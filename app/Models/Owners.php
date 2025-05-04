<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'phone', 'email', 'address'];
}
