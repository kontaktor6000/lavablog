@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Список стран</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Страны</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $country->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
