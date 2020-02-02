@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->has('query'))
                <div class="error_message">
                    {{  $errors->first('query') }}
                </div>
            @endif
            <section>
                <div class="search col-md-12">
                    <form action="{{ route('search') }}" method="get" class="search-form">
                        <i class="fa fa-search search-icon"></i>
                        <input type="text" name="query" id="query" class="search-box" placeholder="search">
                    </form>
                </div>
            </section>
            <section>
                <h1 class="col-md-12">Список книг</h1>
            </section>

            <div class="col-md-12">
            @if (Session::has('flash_add_smell'))
                <div class="alert_success">{{ Session::get('flash_add_smell')  }}</div>
            @endif
            </div>
            <div><a href="{{ route('add_book') }}" class="btn btn-dark">Добавить новую книгу</a></div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название книг</th>
                    <th scope="col">Год издания</th>
                    <th scope="col"><a href="{{ route('authors_list') }}">Авторы</a></th>
                    <th scope="col"><a href="{{ route('publishing_houses_list') }}">Издательства</a></th>
                    <th scope="col"><a href="{{ route('ratings_list') }}">Рейтинг книг (наивысший - 10)<br>
                                                                        оценка / читатель</a></th>
                    <th scope="col">Средний рейтинг</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a href="{{ route('show_book', $book->id) }}">{{ $book->name }}</a></td>
                        <td>{{ $book->years }}</td>
                        <td>{{ $book->author->first_name}} {{ $book->author->last_name}}</td>
                        <td>{{ $book->publishing->name }}</td>
                        {{--<td>@dd($book->rating->assessment)</td>--}}

                        <td>
                            <ul>
                                @php($summ = 0 )
                                @php ($i = 0)
                                @foreach($book->rating as $rating)
                                    <li> {{ $rating->assessment }} / {{ $rating->reader->first_name }} {{ $rating->reader->last_name }}</li>
                                    @php ($summ += $rating->assessment)
                                    @php ($i += 1)
                                @endforeach
                            </ul>
                        </td>
                        <td>@if(isset($i) && $i >0){{ round($summ / $i, 2) }}@endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
