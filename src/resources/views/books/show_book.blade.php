@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Информация о книге</h1>


            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название книги</th>
                    <th scope="col"><a href="{{ route('authors_list') }}">Автор</a></th>
                    <th scope="col"><a href="{{ route('publishing_houses_list') }}">Издательство</a></th>
                    <th scope="col">Год издания</th>
                    <th scope="col"><a href="{{ route('ratings_list') }}">Рейтинг книги (наивысший - 10)<br>
                            оценка / читатель</a></th>
                    <th scope="col">Средний рейтинг</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author->first_name}} {{ $book->author->last_name}}</td>
                        <td>{{ $book->publishing->name }}</td>
                        <td>{{ $book->years }}</td>
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

                </tbody>
            </table>

            <p><a type="button" href="{{ route('edit_book', $book->id) }}" class="btn btn-secondary">Редактировать данные о книге</a></p>
            <p><a type="button" href="{{ route('delete_book', $book->id) }}" class="btn btn-danger">Удалить книгу</a></p>
            <p><a type="button" href="{{ route('books_list') }}" class="btn btn-dark">Вернуться к списку всех книг</a></p>

        </div>
    </div>

@endsection

