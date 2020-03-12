@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <h3 style="margin-top: 20px">Форма просмотра и редактирования пользователя</h3>
                <div class="btn-group col-12 no-gutters "
                     role="group">
                    <a href="{{ route('show_student', ['id' => $student->id]) }}" class="btn btn-primary btn-block" aria-pressed="true">Просмотр профиля</a>
                    <a href="{{ route('likes_list', ['id' => $student->id]) }}" class="btn btn-primary btn-block m-0" aria-pressed="true">Список лайкнувших</a>
                    <a href="{{ route('dialogs_list', ['id' => $student->id]) }}" class="btn btn-primary btn-block m-0" aria-pressed="true">Диалоги</a>
                </div>

                <div>
                    <form class="" method="post" action="{{ route('update_student', [$student->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="first_name"><strong>Имя</strong></label>
                            <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $student->first_name }}">
                        </div>
                        @if($errors->has('first_name'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="middle_name"><strong>Отчество</strong></label>
                            <input type="text" name="middle_name"  class="form-control" id="middle_name" value="{{ $student->middle_name }}">
                        </div>
                        @if($errors->has('middle_name'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('middle_name') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="form-check-label" for="last_name" ><strong>Фамильё</strong></label>
                            <input type="text" name="last_name"  class="form-control" id="last_name"  value="{{ $student->last_name }}">
                        </div>
                        @if($errors->has('last_name'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif

                        <div>
                            <img src="{{ asset('storage/images/' . $student->profile_image) }}" alt="" width="150">
                        </div>

                        <div class="form-group">
                            <label for="profile_image"><strong>Выбрать фото профиля</strong></label>
                            <input type="file" id="profile_image" name="profile_image">
                        </div>

                        <div class="form-group">
                            <label for="birthday"><strong>Дата рождения</strong></label>
                            <input type="date" class="date form-control"
                                   name="birthday" id="birthday"
                                   value="{{ $student->birthday }}">
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
                                    <option value="{{ $gender->id }}"
                                        @if($student->gender_id == $gender->id)
                                        selected
                                        @endif
                                    >{{ $gender->name }}</option>
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
                                    {{--@if($country->id == $student->city->country_id)
                                        selected
                                    @endif --}}
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
                                        @if($city->id == $student->city_id)
                                            selected
                                        @endif
                                    >{{ $city->name }}j</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="userAboutYourself">О себе</label>
                            <textarea class="form-control"
                                      id="userAboutYourself"
                                      rows="3"
                                      placeholder="Расскажите немного о себе...">
                                {{ $student->about }}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection()
