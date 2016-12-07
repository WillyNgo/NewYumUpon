<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'rating', 'resto'];
    
    /**
     * Get the restaurant that owns the review.
     */
    public function resto()
    {
        return $this->belongsTo('App\Resto');
    }
    
    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
