@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="search col-md-12">
                <form action="{{ route('search') }}" method="get" class="search-form">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box" placeholder="search">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Search results</h1>

                    @if ($errors->has('query'))
                        <div class="error_message">
                            {{  $errors->first('query') }}
                        </div>
                    @endif



                <p>{{ $books->count() }} results for <strong>{{ request()->input('query') }}</strong></p>

                <table class="table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Название</td>
                        <td>Автор</td>
                        <td>Год издания</td>
                        <td>Издательство</td>
                        <td>Владелец издания <br>(город/страна)</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('show_book', $book->id) }}">{{ $book->name }}</a></td>
                            <td>{{ $book->author->first_name }} {{ $book->author->second_name }}</td>
                            <td>{{ $book->years }}</td>
                            <td>{{ $book->publishing->name }}</td>
                            <td>{{ $book->publishing->owner->first_name }} {{ $book->publishing->owner->first_name }}<br>
                                ({{ $book->publishing->city->name }} / {{ $book->publishing->city->country->name }})
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
        </div>
    </div>


@endsection
