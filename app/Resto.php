<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'genre', 'pricing','civic', 'street', 'city', 'postalcode',];
    protected $primaryKey = 'restoid';
    
    /**
     * Get all of the reviews for a restaurant.
     */
    public function reviews(){
        return $this->hasMany('App\Review');
    }

    /**
     * Returns the user that added this restaurant
     */
    public function users(){
        return $this->belongsTo('App\User');
    }

}
