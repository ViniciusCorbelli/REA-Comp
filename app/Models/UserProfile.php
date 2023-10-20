<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street',
        'number',
        'additional_info',
        'neighborhood',
        'state',
        'city',
        'country',
        'zipcode',
        'storage'
    ];
}
