@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Список издательских домов</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Издательские дома</th>
                    <th scope="col"><a href="{{ route('cities_list') }}">Города</a></th>
                    <th scope="col"><a href="{{ route('owners_list') }}">Владельцы</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($publishingHousesList as $publishingHouse)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $publishingHouse->name }}</td>
                    <td>{{ $publishingHouse->city->name }}</td>
                    <td>{{ $publishingHouse->owner->first_name }} {{ $publishingHouse->owner->last_name }}</td>
                </tr>
                @endforeach.
'
                </tbody>
            </table>
        </div>
    </div>

@endsection
