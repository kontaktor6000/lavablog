@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Список городов</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Названия городов</th>
                    <th scope="col"><a href="{{ route('countries_list') }}">Страны</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->country->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

