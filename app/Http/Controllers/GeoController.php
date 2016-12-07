<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class GeoController extends Controller
{
    public function index(Request $request)
    {
        $error = $request->input('error');
        //if no errors, grab latitude and longitude
        if($error == 0)
        {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $geoResult = ['OK',$latitude,$longitude];

            $request->session()->put('geoResult',$geoResult);
        }
        else{
            $postal = $request->input('postal');
            $geoResult = $this->GetGeocodingSearchResults($postal,$request);
            $request->session()->put('geoResult',$geoResult);
        }

        if($geoResult[0] == 'OK')
            return redirect()->action('HomeController@index');
        else
            return view('welcome');

    }



    public function GetGeocodingSearchResults($address,Request $request) {
        $address = urlencode($address); //Url encode since it was provided by user
        $url = "http://maps.google.com/maps/api/geocode/xml?address={$address}&sensor=false";

        // Retrieve the XML file
        $results = file_get_contents($url);
        $xml = new \DOMDocument();//backslash to indicate global namespace
        $xml->loadXML($results);
        $check = $xml->getElementsByTagName('status')->item(0)->nodeValue;
        if($check == 'OK') {
            $latitude = $xml->getElementsByTagName('lat')->item(0)->nodeValue;
            $longitude = $xml->getElementsByTagName('lng')->item(0)->nodeValue;
            $request->session()->put('postal', $address);
            $geoResult = [$check,$latitude,$longitude];
        }
        else{
            $geoResult = [$check];
        }
        return $geoResult;
    }

}
