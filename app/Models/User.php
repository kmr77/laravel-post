<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\NewVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    // protected $table = 'users';
    protected $dates = ['deleted_at'];

    public function sendEmailVerificationNotification(){
        $this->notify(new NewVerifyEmail());
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function plans() {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'aplan',
        'bplan',
        'cplan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
