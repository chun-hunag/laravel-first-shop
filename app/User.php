<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'cellphone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * remember_token mutator
     * @return void
     */
    public function setRememberTokenAttribute($token)
    {
        $this->attributes['remember_token'] = bcrypt($token);
    }

    /**
     * remember_token accessor
     * @return string
     */
    public function getRememberTokenAttribute($token)
    {
        return $token;
    }


    /**
     * Generate reset password token;
     * @return string
     */
    public static function genResetPasswordToken()
    {
        return Str::random(60);
    }

}
