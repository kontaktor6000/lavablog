@extends('layouts.app')

@section('content')
<div class="container">


            .
        <div class="row">
            <div class="col-md-4">
                <aside>
                    <form  action="" method="get" class="search-form">
                        <div class="form-group">
                            <label for="book_name">Название книги</label>
                            <input type="text"
                                   name="book_name"
                                   value="{{ request()->book_name }}"
                                   class="form-control"
                                   placeholder="Мастер и ламастер">
                        </div>
                        <div class="form-group">
                            <label for="author_name">Автор</label>
                            <input type="text"
                                   name="book_author"
                                   value="{{ request()->book_author }}"
                                   class="form-control"
                                   placeholder="Бурлаков Толпа">
                        </div>

                        <div class="form-group">
                            <label for="publishing_house">Publishing House</label>
                            <select class="form-control" name="publishing_house" id="publishing_house">
                                <option value=""></option>
                                @foreach($publishingHouses as $publishingHouse)
                                    <option value="{{ $publishingHouse->id }}"
                                        @if($publishingHouse->id == $request->publishing_house)
                                        {{ 'selected' }}
                                        @endif>{{ $publishingHouse->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="owner">Owners</label>
                            <select class="form-control" name="owner" id="owner">
                                <option value=""></option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}"
                                    @if($owner->id == $request->owner)
                                        {{ 'selected' }}
                                        @endif>{{ $owner->first_name }} {{ $owner->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                           {{--             <div class="form-group">
                                            <label for="country">Страна</label>
                                            <select class="form-control" name="country" id="country">
                                                @foreach($countries as $countrie)
                                                    <option value="{{ $countrie->id }}">{{ $countrie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Город</label>
                                            <select class="form-control" name="country" id="country">
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>--}}
                        <button type="submit" class="btn btn-dark">Найти книги</button>
                    </form>
                </aside>
            </div>
            <div class="search col-md-8">
                @foreach($books as $book)
                <div class="card" style="width: 18rem;">
                    {{--<img class="card-img-top" src="..." alt="Card image cap">--}}
                    <div class="card-body">
                        <p class="card-text">Название книги:</p>
                        <h4 class="card-title">{{ $book->name }}</h4>
                        <p class="card-text">Год издания: {{ $book->years}}</p>
                        <p class="card-text">Автор: {{ $book->author->first_name }} {{ $book->author->second_name }}</p>
                        <p class="card-text">Издательство: {{ $book->publishing->name }}</p>
                        <p class="card-text">Владелец: {{ $book->publishing->owner->first_name }} {{ $book->publishing->owner->last_name }}</p>
                        <a href="{{ route('show_book', $book->id) }}" class="btn btn-primary">Подробнее о книге</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>




</div>
@endsection

{{--@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->has('query'))
                <div class="error_message col-md-12">
                    {{  $errors->first('query') }}
                </div>
            @endif


            <section>
                <div class="search col-md-12">

                    <form  action="{{ route('search_with_selection) }}" method="get" class="search-form">
                        <div class="form-group">
                            <label for="book_name">Название книги</label>
                            <input type="text" name="book_name"  class="form-control"placeholder="Мастер и ламастер">
                        </div>
                        <div class="form-group">
                            <label for="author_name">Автор</label>
                            <input type="text" name="book_author"  class="form-control"placeholder="Бурлаков Толпа">
                        </div>
                        <div class="form-group">
                            <label for="publishing_house">Publishing House</label>
                            <select class="form-control" name="publishing_house" id="publishing_house">
                                @foreach($publishingHouses as $publishingHouse)
                                    <option value="{{ $publishingHouse->id }}">{{ $publishingHouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark">Dark</button>

                    </form>


                </div>
            </section>

            <section>
                <h1 class="col-md-12">Список книг</h1>
            </section>

            --}}{{--            <div class="col-md-12">
                        @if (Session::has('flash_add_smell'))
                            <div class="alert_success">{{ Session::get('flash_add_smell')  }}</div>
                        @endif
                        </div>--}}{{--
            <div><a href="--}}{{--{{ route('add_book') }}--}}{{--" class="btn btn-dark">Добавить новую книгу</a></div>
            --}}{{--<table class="table">
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
                        --}}{{----}}{{--<td>@dd($book->rating->assessment)</td>--}}{{----}}{{--

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
            </table>--}}{{--
        </div>
    </div>

@endsection--}}

