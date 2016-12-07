<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'postalcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all the restaurants added by the user
     */
    public function restos(){
        return $this->hasMany('App\Resto');
    }

    /**
     * Get all of the reviews by a user.
     */
    public function reviews(){
        return $this->hasMany('App\Review');
    }
}
