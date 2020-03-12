@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('widgets.left_menu')
        </div>
        <div class="col-md-9">
            <h2 style="margin-top: 10px">Форма добавления пользователя</h2>

            <form class="" method="post" action="{{ route('store_students') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="first_name"><strong>Имя</strong></label>
                    <input type="text" name="first_name" class="form-control"
                           id="first_name" value="{{ old('first_name') }}">
                </div>
                @if($errors->has('first_name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="middle_name"><strong>Отчество</strong></label>
                    <input type="text" name="middle_name"  class="form-control"
                           id="middle_name" value="{{ old('middle_name') }}">
                </div>
                @if($errors->has('middle_name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-check-label" for="last_name"><strong>Фамильё</strong></label>
                    <input type="text" name="last_name"  class="form-control"
                           id="last_name"  value="{{ old('last_name') }}">
                </div>
                @if($errors->has('last_name'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif


                <div class="form-group">
                    <label for="profile_image"><strong>Выбрать фото профиля</strong></label>
                    <input type="file" id="profile_image" name="profile_image" value="{{ old('profile_image') }}">
                </div>
                @if($errors->has('profile_image'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('profile_image') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="birthday"><strong>Дата рождения</strong></label>
                    <input type="date" class="date form-control" name="birthday"
                           id="birthday"  value="{{ old('birthday') }}">
                </div>
                @if($errors->has('birthday'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('birthday') }}
                    </div>
                @endif


                <div class="form-group">
                    <label for="userGender">Пол</label>
                    <select id="userGender" name="gender" class="form-control"  value="{{ old('gender') }}">
                        @foreach($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="userCountry">Страна</label>
                    <select id="userCountry"
                            name="country_id"
                            class="form-control">
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                        @if(isset($request->country_id) && $country->id == $request->country_id)
                            {{ 'selected' }}
                        @endif
                        >{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="userCity">Город</label>
                    <select id="userCity"
                            name="city_id"
                            class="form-control">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}"
                            @if(isset($request->city_id) && $city->id == $request->city_id)
                                {{ 'selected' }}
                            @endif
                            >{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="about">О себе</label>
                    <textarea class="form-control"
                              name="about"
                              id="about"
                              rows="3"
                              placeholder="Расскажите немного о себе...">
                          {{ old('about') }}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection()
