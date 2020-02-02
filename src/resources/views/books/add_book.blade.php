@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

            <div class="col-md-4">
                <div class="sidebar">
                    <div class="sidebar__heading">
                        <img src="http://93.119.155.54:1100/img/avatar.svg" alt="Avatar" class="sidebar__avatar">
                    </div>
                    <div class="link-book">
                            <a href="{{ route('books_list') }}" class="btn btn-dark">Список книг</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <form method="post" action="">
                    @csrf
                    <div class="form-group">
                        <label for="nameBook">Name book</label>
                        <input type="text" class="form-control"
                               name="bookName" id="bookName"
                               value="{{ old('bookName') }}" placeholder="Small earth">
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
                                <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->second_name }}</option>
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
                               value="{{ old('year') }}" placeholder="1955">
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
                            <option value="{{ $publishingHouse->id }}">{{ $publishingHouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('publishingHouseId'))
                        <div class="error_message">
                            {{  $errors->first('publishingHouseId') }}
                        </div>
                    @endif
                    <input type="submit" class="btn btn-dark" value="Добавить книгу">
                </form>
            </div>

    </div>
</div>
@endsection

