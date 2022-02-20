<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id',
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
    public function telegram()
    {
        return $this->hasOne(Telegram::class);
    }
    public function histories()
    {
        return $this->hasMany(History::class);
    }
    public function mlogs()
    {
        return $this->hasMany(Mlog::class);
    }
    public function isAdmin()
    {
        return $this->email == env('USER_ADMIN');
    }
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new \App\Notifications\RegisterNotification(Auth::user()));  //pass the currently logged in user to the notification class
    // }

}
