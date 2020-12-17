<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAge extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'name', 'age'
    ];
    protected  $table = 'users_age';
}
