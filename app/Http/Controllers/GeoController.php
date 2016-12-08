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
            echo "<script>alert('".$geoResult[0]."')</script>";
        }
        elseif(session()->has('postal'))
        {
            return redirect()->action('HomeController@index');
        }
        else{
            $postal = $request->input('postal');
            $geoResult = $this->GetGeocodingSearchResults($postal,$request);

        }

        if($geoResult[0] == 'OK') {
            $request->session()->put('postal', $postal);
            $request->session()->put('geoResult', $geoResult);
            echo "<script>alert('".$geoResult[0]."GEOCONTROLLER')</script>";
            return redirect()->action('HomeController@index');
        }
        else {
            $request->session()->remove('geoResult');
            return view('welcome',['errPostal'=> 'Invalid postal code entered!']);
        }

    }



    public function GetGeocodingSearchResults($address,Request $request) {
        $address = urlencode($address); //Url encode since it was provided by user
        if($address!=null) {
            $url = "http://maps.google.com/maps/api/geocode/xml?address={$address}&sensor=false";

            // Retrieve the XML file
            $results = file_get_contents($url);
            $xml = new \DOMDocument();//backslash to indicate global namespace
            $xml->loadXML($results);
            $check = $xml->getElementsByTagName('status')->item(0)->nodeValue;
        }else{
            $check = 'FAIL';
        }
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