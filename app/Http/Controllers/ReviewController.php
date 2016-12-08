<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new review.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request,[
            'title' => 'required|max:255',
            'rating' => 'max:1|regex:/^[1-5]?$/',
            'content' => 'required|max:255',
        ]);

        echo "<script>alert('".$request->title."')</script>";
        echo "<script>alert('".$request->restoid."')</script>";
        echo "<script>alert('".$request->rating."')</script>";
        echo "<script>alert('".$request->content."')</script>";

        $userid = Auth::id();
        $review = new Review();
        $review->resto = $request->restoid;
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->content = $request->content;
        $review->user = $userid;

        $review->save();




        return redirect('/detailResto/'.$request->restoid);
    }
}
