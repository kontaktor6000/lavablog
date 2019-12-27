<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$title}}</title>
        <meta name="description" content="{{$description}}" >
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Weather in {{$city}}
                </div>

                <div class="links">
                    <ul>
                        <li>Температура: {{$weatherData['main']['temp'] - 273.15}} &deg;C</li>
                        <li>Влажность: {{$weatherData['main']['humidity']}} %</li>
                        <li>Давление: {{$weatherData['main']['pressure']}}  hpa</li>
                        <li>Скорсть ветра: {{$weatherData['wind']['speed']}} m/s</li>
                    </ul>
                </div>

                <div class="title m-b-md">
                    Выберите город
                </div>
                <div class="links">
                    <form action="" method="post">

                        <select name="city" id="">
                            <option disabled>Выберите город</option>
                            @foreach ($cityNameList as $city)
                                <option value="{{$city}}">{{$city}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Подтвердить выбор">
                    </form>
                </div>


            </div>
        </div>
    </body>
</html>
