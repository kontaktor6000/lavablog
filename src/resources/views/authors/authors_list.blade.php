@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Список стран</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Авторы</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $author->first_name }} {{ $author->second_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
