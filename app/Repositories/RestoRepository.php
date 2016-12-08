<?php
namespace App\Repositories;
use App\Resto;
use Illuminate\Database\Eloquent\Collection;

/**
 * Created by PhpStorm.
 * User: Salman Haidar
 * Date: 2016-11-28
 * Time: 9:47 PM
 */
class RestoRepository
{

    public function getRestosNear($latitude, $longitude, $radius = 50){

        $restos = Resto::select('restos.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?))
                           + sin( radians(?) ) *
                           sin( radians(latitude ) ) )
                         ) AS distance', [$latitude, $longitude, $latitude])
            ->whereRaw("'distance' < ? ", [$radius])
            ->orderBy('distance')
            ->limit(20)
            ->get();


        return $restos;
    }

    public function get10RestosNear($latitude, $longitude, $radius = 50){

        $restos = Resto::select('restos.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?))
                           + sin( radians(?) ) *
                           sin( radians(latitude ) ) )
                         ) AS distance', [$latitude, $longitude, $latitude])
            ->whereRaw("'distance' < ? ", [$radius])
            ->orderBy('distance')
            ->limit(10)
            ->get();


        return $restos;
    }

    public function getAllRestos()
    {
        
    }

}