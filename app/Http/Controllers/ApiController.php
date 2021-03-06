<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Resto;
use App\Review;
use App\Repositories\RestoRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function __construct(RestoRepository $resto, ReviewRepository $review)
    {
        $this->resto = $resto;
        $this->review = $review;
    }

    /**
     * Gets all restaurant near the specified latitude and longitude
     * @param Request $request
     * @param $lat
     * @param $long
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRestosNear(Request $request, $lat, $long)
    {
        //$geoResult = $request->session()->get('geoResult');

        $restos = $this->resto->get10RestosNear($lat, $long);
        return response()->json($restos, 200);
    }

    /**
     * Gets all reviews associated with a specified restaurant id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRestoReviews(Request $request, $id)
    {
        $reviews = $this->review->getReviewsForId($id);
        return response()->json($reviews, 200);
    }

    /**
     * This method will add a review for a restaurant
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addreview(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');  //Only Some Of The Request Input
        $valid = Auth::once($credentials); //logs in for this time only, no session or cookies
        if (!$valid)
            return response()->json(['error' => 'invalid_credentials'], 401);
        else {
            //interact with model
            $userid = Auth::id();
            $review = new Review();
            $review->resto = $request->restoid;
            $review->title = $request->title;
            $review->rating = $request->rating;
            $review->content = $request->content;
            $review->user = $userid;

            $review->save();

            $dataArray = [
                'status' => 'OK',
                'message' => 'Review successfully added!',
                'userid' => $userid,
            ];

            return response()->json($dataArray, 200);

        }
    }

    /**
     * Add a restaurant from request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addresto(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        var_dump($request["email"]);
        var_dump($request["password"]);//Only Some Of The Request Input

        $valid = Auth::once($credentials); //logs in for this time only, no session or cookies
        if (!$valid)
            return response()->json(['error' => 'invalid_credentials'], 401);
        if (Resto::where('name', '=', $request->name)->count() > 0 && Resto::where('postalcode', '=', $request->postalcode)->count() > 0) { // Check for duplicate
            return response(400);
        } else {    //interact with model
            $userid = Auth::id();
            $resto = new Resto;
            $resto->name = $request->name;
            $resto->genre = $request->genre;
            $resto->pricing = $request->pricing;
            $resto->addedBy = $userid;
            $resto->address = $request->address;
            $resto->city = $request->city;
            $resto->postalcode = $request->postalcode;
            $resto->longitude = $request->longitude;
            $resto->latitude = $request->latitude;
            $resto->save();

            $dataArray = [
                'status' => 'OK',
                'message' => 'Restaurant successfully added!',
                'userid' => $userid,
            ];

            return response()->json($dataArray, 200);
        }
    }
}
