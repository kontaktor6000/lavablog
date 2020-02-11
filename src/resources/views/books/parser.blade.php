@extends('layouts.app')

@section('content')

    @foreach ($publishingHouses as $publishingHouse)
        <h4>{{ $publishingHouse['name'] }}</h4>
        <p>{{ $publishingHouse['image'] }}</p>
        <hr>
    @endforeach

{{--@yield($data);--}}

@endsection
