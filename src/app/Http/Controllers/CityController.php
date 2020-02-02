<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with(['country'])->get();


        //$publishingHousesList = PublishingHouse::with(['owner', 'city'])->get();

        return view('cities.cities_list', [
            'cities'              => $cities,
        ]);
    }
}
