<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    const USER_TYPE_ADMIN = 'admin';
    const USER_TYPE_USER = 'user';
    const ACTIVE = 'active';
    const PENDING = 'pending';
    const INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'phone_number',
        'status',
        'email',
        'password',
        'storage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public function isAdministrator() {
        return $this->user_type == self::USER_TYPE_ADMIN;
    }
    
    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function repositories() {
        return $this->hasMany(Repository::class);
    }

    public function favorities() {
        return $this->belongsToMany(Repository::class, 'favorities');
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }
}
