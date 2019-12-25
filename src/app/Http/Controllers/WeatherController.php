<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{

    public function indexAction($city = 'Kiev') {
        $ch = curl_init();
        $appId = config('weather.appId');
        $weatherSite = config('weather.weatherSite');
        $cityNameList = config('weather.cityNameList');

        //var_dump($cityNameList);die;

        $format = "%s?q=%s&APPID=%s";
        $url = sprintf($format, $weatherSite, $city, $appId);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $weatherData = curl_exec($ch);
        $weatherData = json_decode($weatherData, true);

        //var_dump($weatherData);die;

        $data = [
            'title' => 'Погода в городе - ' . $city,
            'description' => 'Температура, давление, направление и скорость ветра в городе ' . $city,
            'city' => $city,
            'weatherData' => $weatherData,
            'cityNameList' => $cityNameList,
        ];

        return view('weather', $data);

    }

    public function choosedCityNameAction(Request $request) {

        $name = $request->input('city');
        var_dump($name);die;

/*        $data = [
            'title' => 'Погода в городе - ' . $city,
            'description' => 'Температура, давление, направление и скорость ветра в городе ' . $city,
            'city' => $city,
            'weatherData' => $weatherData,
            'cityNameList' => $cityNameList,
        ];

        return view('weather', $data);*/
    }

}
