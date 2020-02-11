<?php


namespace App\Http\Controllers;


use http\Header;

class WhoisthisController extends Controller
{

    public function whoIsThis ()
    {
        $userAgents = [
            'Android' => 'https://google.com',
            'iPhone' => 'https://apple.com',
            'Window' => 'https://laravel.com/',
        ];

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        foreach ( $userAgents as $userOS => $site) {
            if (strpos($userAgent, $userOS )) {
                header('Location: ' . $site);
            }
        }
        echo 'Versiya dlya PC ne podderzhivaetsya';

    }

}
