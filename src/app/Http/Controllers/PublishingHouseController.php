<?php

namespace App\Http\Controllers;

use App\City;
use App\PublishingHouse;
use Illuminate\Http\Request;

class PublishingHouseController extends Controller
{
    public function index()
    {
        $publishingHousesList = PublishingHouse::with(['owner', 'city'])->get();

        $cities = City::get();

        return view('publishing_house.publishing_houses', [
            'publishingHousesList' => $publishingHousesList,
            'cities'               => $cities,
            ]);
    }


}
