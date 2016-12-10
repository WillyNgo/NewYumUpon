<?php

namespace App\Http\Controllers;

use App\Resto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Repositories\ReviewRepository;
use App\Http\Controllers\GeoController;

class RestoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReviewRepository $review)
    {
        $this->review = $review;
    }

    /**
     * Display a list of all of the user's restaurants.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $restos = DB::table('restos')->where('addedBy', '=', Auth::id())
            ->paginate(10);
        $reviews = $this->review->getReviews();
        return view('restos.index', ['restos' => $restos, 'reviews' => $reviews]);
    }

    /**
     * Displays detail of a restaurant
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRestoDetails(Request $request, $id)
    {
        $resto = Resto::find($id);
        if ($resto != null) {
            $review = $this->review->getAllForId($id);
            return view('restos.detailResto', ['resto' => $resto, 'reviews' => $review]);
        } else{
            abort(404);
        }
    }

    /**
     * Allows user to update information of a current restaurant
     * @param Request $request
     * @return $this
     */
    public function updateResto(Request $request, $id)
    {
        $resto = Resto::find($id);
        return view('restos.updateResto', ['resto' => $resto]);
    }

    /**
     *
     */
    public function addResto(Request $request)
    {
        return view('restos.addResto');
    }
    /**
     * Create a new restaurant.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required',
            'postalcode' => 'max:6|min:6|regex:/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ] ?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i',
            'city' => 'nullable|regex:/^[A-Za-z]*-? ?[A-Za-z]*$/',
            'genre' => 'required|regex:/^[A-Za-z]*-? ?[A-Za-z]*$/',
            'pricing' => 'required',
        ]);

        $userid = Auth::id();
        $resto = new Resto;
        $resto->name = $request->name;
        $resto->genre = $request->genre;
        $resto->pricing = $request->pricing;
        $resto->addedBy = $userid;
        $resto->address = $request->address;

        $mylocation = app('App\Http\Controllers\GeoController')->GetGeocodingSearchResults($request->address, $request);

        $resto->city = $request->city;
        $resto->postalcode = $request->postalcode;
        $resto->longitude = $mylocation[2];
        $resto->latitude = $mylocation[1];
            $resto->save();


        return redirect('/restos');
    }


    /**
     * Updates restaurant in database
     * @param Request $request
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'genre' => 'required|regex:/^[A-Za-z]*-? ?[A-Za-z]*$/',
            'postalcode' => 'max:6|min:6|regex:/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ] ?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i',
            'city' => 'nullable|regex:/^[A-Za-z]*-? ?[A-Za-z]*$/',
            'genre' => 'required|regex:/^[A-Za-z]*-? ?[A-Za-z]*$/',
            'pricing' => 'required',
        ]);
        $restoToUpdate = Resto::find($id);

        $restoToUpdate->name = $request->name;
        $restoToUpdate->address = $request->address;
        $restoToUpdate->postalcode = $request->postalcode;
        $restoToUpdate->city = $request->city;
        $restoToUpdate->genre = $request->genre;
        $restoToUpdate->pricing = $request->pricing;
        $restoToUpdate->save();
        
        return redirect('/restos');
    }

    /**
     * Check if a restaurant already exists in the database, returns true if there is. False otherwise
     * @param $restoname
     * @param $restoaddress
     */
    public function checkIfRestoAlreadyExists($restoname, $restoaddress)
    {
        echo "<script>alert('IN CHECKING.')</script>";
        $restos = DB::table('restos')->where('name', 'LIKE', '%'.$restoname.'%')
            ->orWhere('address', 'LIKE', '%'.$restoaddress.'%')
            ->get();

        return (!empty($restos));
    }
}
