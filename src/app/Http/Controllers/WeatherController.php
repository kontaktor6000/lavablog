<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function defaultAction(WeatherService $service)
    {
        $city = config('config.weather.default_city');
        $weather = $service->getCityWeather($city);

    }
}
