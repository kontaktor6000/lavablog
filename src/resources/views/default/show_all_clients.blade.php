@extends('default.layouts.layout')
@section('content')
    <!--Создание фейкового пользователя-->
    <div class="border-bottom
                    no-gutters
                    col-12
                    mb-2">
        <p class="text-secondary
                      text-center
                      py-2
                      pb-3
                      m-0
                      h3">Список всех клиентов нашей психбольницы</p>
    </div>

    <table class="table table-responsive">
        <tr>
            <td>Имя</td>
            <td>Аватар</td>
            <td>Дата рождения</td>
            <td>Пол</td>
            <td>О себе</td>
            <td>Страна</td>
            <td>Город</td>
        </tr>
        @foreach($clients as $client)
        <tr>
            <td><strong>{{ $client->name }}</strong></td>
            <td><img class="img-fluid" width="200" src="{{ asset('/storage/' . $client->avatar) }}" alt=""></td>
            <td>{{ $client->date_of_birth }}</td>
            <td>{{ $client->gender }}</td>
            <td>{{ $client->description }}</td>
            <td>{{--{{ $client->country }}--}}</td>
            <td>{{ $client->city_id }}</td>
        </tr>
        @endforeach
    </table>


@endsection

