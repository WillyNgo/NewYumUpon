<?php
/**
 * Created by PhpStorm.
 * User: SalmonWitcher
 * Date: 2016-12-05
 * Time: 7:12 AM
 */

namespace App\Repositories;
use App\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ReviewRepository
{
    /**
     * Gets all reviews written by a specified a resto id
     *
     * @param $id
     * @return mixed
     */
    public function getAllForId($id)
    {
       return DB::table('users')
            ->join('reviews','users.id','=','reviews.user')
            ->select('reviews.title','users.name','reviews.content','reviews.rating')
            ->where('resto','=',$id)
            ->orderby('reviews.created_at','desc')
            ->paginate(5);


    }

    public function getReviewsForId($id)
    {
        return DB::table('users')
            ->join('reviews','users.id','=','reviews.user')
            ->select('reviews.title','users.name','reviews.content','reviews.rating')
            ->where('resto','=',$id)
            ->orderby('reviews.created_at','desc');
    }

    public function getReviews()
    {
        $reviews = Review::all();

        return $reviews;
    }

    /**
     * Returns the number of reviews associated to restaurant
     * @param $id
     */
    public function getNumberOfReviews($id)
    {
        $reviews = Review::where('resto', '=', $id)
                    ->get();
        $count = 0;
        foreach($reviews as $review){
            $count++;
        }

        return $count;
    }
}