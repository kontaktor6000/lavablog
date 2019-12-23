<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WeatherRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather_request {city_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weather_request description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ch = curl_init();

        $city_name = $this->argument('city_name');
        $appId = config('weather.appId');

        $format = "http://api.openweathermap.org/data/2.5/weather?q=%s&&APPID=%s";
        $url = sprintf($format, $city_name, $appId);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $weatherData = curl_exec($ch);
        $weatherData = json_decode($weatherData, true);

        echo $weatherData['name'] . PHP_EOL;
        echo $weatherData['weather'][0]['main'] . PHP_EOL;
        echo $weatherData['main']['temp'] - 273.15 . PHP_EOL;

    }
}
