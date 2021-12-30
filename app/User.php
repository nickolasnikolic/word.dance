<?php

namespace App;

use Laravel\Scout\Searchable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'email_verified_at','remember_token', 'stripe_uid', 'access_token', 'refresh_token', 'scope'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function poem(){
        return $this->hasMany('App\Poem');
    }

    public function purchase(){
        return $this->hasMany('App\Purchase');
    }

    public function sponsorship(){
        return $this->hasMany('App\Sponsorship');
    }
}
