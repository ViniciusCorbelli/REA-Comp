<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Repository extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'topic_id',
        'type_id',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    public function files() {
        return $this->hasMany(File::class);
    }

    public function links() {
        return $this->hasMany(Link::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
