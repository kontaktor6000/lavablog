@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Список городов</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Владелец</th>
                    <th scope="col"><a href="{{ route('publishing_houses_list') }}">Издательский дом</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($owners as $owner)
                   {{--@yield(dd($owners->publishing->name))--}}
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $owner->first_name }} {{ $owner->last_name }}</td>
                        <td>
                            <ul>
                                @foreach($owner->publishing as $publishingHouse)
                                <li>{{ $publishingHouse->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

