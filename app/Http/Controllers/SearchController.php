<?php

namespace App\Http\Controllers;


use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\ReviewRepository;

class SearchController extends Controller
{
    protected $searchTerm;

    public function __construct()
    {

    }

    public function index(Request $request){
        return view('search.index');
    }

    /**
     * Returns view with all of the search results.
     *
     * @param  Request  $request
     * @return Response
     */
    public function search(Request $request)
    {
        $this->validate($request, ['keyword' => 'max:255']);

        $restos = DB::table('restos')->where('name', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('genre', 'LIKE', '%'.$request->keyword.'%')
            ->orderBy('name')
            ->paginate(20);

        $reviews = DB::table('reviews')->get();
        return view('search.index', ['restos' => $restos, 'reviews' => $reviews]);
    }
}