@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="sidebar">
                    <div class="sidebar__heading">
                        <img src="http://93.119.155.54:1100/img/avatar.svg" alt="Avatar" class="sidebar__avatar">
                    </div>
                    <ul class="sidebar__list">
                        <li>
                            <a href="{{ route('books_list') }}" class="sidebar__link">Список книг</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <form method="post" action="{{ route('update_book', $book->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="nameBook">Name book</label>
                        <input type="text" class="form-control"
                               name="bookName" id="bookName"
                               value="{{ $book->name }} {{ $book->author->id }}" placeholder="Small earth">
                    </div>
                    @if ($errors->has('bookName'))
                        <div class="error_message">
                            {{  $errors->first('bookName') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Authors</label>
                        <select class="form-control" name="authorId" id="author">
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}"
                                        @if($author->id === $book->author->id)
                                        {{ 'selected' }}
                                        @endif>
                                    {{ $author->first_name }} {{ $author->second_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('authorId'))
                        <div class="error_message">
                            {{  $errors->first('authorId') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="year">Year publishing</label>
                        <input type="text" class="form-control"
                               name="year" id="year"
                               value="{{ $book->years }}" placeholder="1955">
                    </div>
                    @if ($errors->has('year'))
                        <div class="error_message">
                            {{  $errors->first('year') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="publishingHouseId">Publishing House</label>
                        <select class="form-control" name="publishingHouseId" id="publishingHouse">
                            @foreach($publishingHouses as $publishingHouse)
                                <option value="{{ $publishingHouse->id }}"
                                        @if($publishingHouse->id === $book->publishing->id)
                                        {{ 'selected' }}
                                        @endif>
                                    {{ $publishingHouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('publishingHouseId'))
                        <div class="error_message">
                            {{  $errors->first('publishingHouseId') }}
                        </div>
                    @endif
                    <input type="submit" class="btn btn-dark" value="Сохранить изменения">
                </form>
            </div>

        </div>
    </div>
@endsection
