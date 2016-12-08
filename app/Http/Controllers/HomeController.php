<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RestoRepository;
use App\Repositories\ReviewRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RestoRepository $resto, ReviewRepository $review)
    {

        $this->resto = $resto;
        $this->review = $review;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $geoResult = $request->session()->get('geoResult');

        $restos = $this->resto->getRestosNear($geoResult[1],$geoResult[2]);
        $reviews = $this->review->getReviews();

        echo "<script>alert('".$geoResult[1]."')</script>";
        echo "<script>alert('".$geoResult[2]."')</script>";
        echo "<script>alert('".$restos->resto->name."')</script>";


        return view('home',['restos' => $restos, 'reviews' => $reviews]);
    }
}
