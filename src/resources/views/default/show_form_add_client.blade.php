@extends('default.layouts.layout')
@section('content')
<!--Создание фейкового пользователя-->
    <div class="border-bottom
                    no-gutters
                    col-12
                    mb-2">
        <p class="text-secondary
                      text-center
                      py-2
                      pb-3
                      m-0
                      h3">Создание фейкового пользователя</p>
    </div>

    <form action="{{ route('store_new_client') }}"
          method="post"
          enctype="multipart/form-data"
          class="text-secondary
                     border-bottom
                     p-2">
        @csrf
        <div class="form-group">
            <label for="nameInput">Имя</label>
            <input name="name"
                   type="text"
                   class="form-control"
                   id="nameInput"
                   placeholder="Введите имя">
        </div>

        <div class="form-group">
            <label for="userProfilePhoto">Фото</label>
            <div class="userProfilePhoto
                    mb-2">
                <img src="http://www.bienhealth.com/img/articles/5-genov-forma-chelovecheskogo-litsa.jpg"
                     class="image-fluid"
                     alt="userProfilePhoto">
            </div>

            <div class="custom-file">
                <input name="avatar" type="file" class="custom-file-input" id="userProfilePhoto" required>
                <label class="custom-file-label"
                       for="userProfilePhoto">Выберите файл</label>
            </div>
        </div>

        <div class="form-group">
            <label for="dateBirthday">Дата рождения</label>
            <input type="date"
                   name="day_of_birth"
                   id="dateBirthday"
                   class="form-control">
        </div>

        <div class="form-group">
            <label for="userGender">Пол</label>
            <select id="userGender"
                    name="gender"
                    class="form-control">
                <option>Мужской</option>
                <option>Женский</option>
            </select>
        </div>

        <div class="form-group">
            <label for="userCountry">Страна</label>
            <select id="userCountry"
                    name="country"
                    class="form-control">
                @foreach($countries as $country)
                <option>Страна 1</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="userCity">Город</label>
            <select id="userCity"
                    name="city"
                    class="form-control">
                @foreach($countries as $country)
                    <option>City 1</option>
                @endforeach
            </select>

            {{--<input type="text"
                   name="city"
                   id="userCity"
                   class="form-control"
                   placeholder="Укажите город">--}}
        </div>

        <div class="form-group">
            <label for="userAboutYourself">О себе</label>
            <textarea class="form-control"
                      name="description"
                      id="userAboutYourself"
                      rows="3"
                      placeholder="Расскажите немного о себе..."></textarea>
        </div>

        <input type="submit"
               class="btn
                   btn-primary
                   btn-success"
               value="Сохранить">
    </form>
@endsection
