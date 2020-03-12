@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <div class="btn-group col-12 no-gutters" role="group">
                    <a href="{{ route('event_add') }}" class="btn btn-dark" >Добавить мероприятие</a>
                </div>
                <h2 style="margin-top: 20px">Список участников мероприятия - {{--{{ $event->event_name }}--}}</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Прошел модерацию</th>
                        <th scope="col">Возраст</th>
                        <th scope="col">Пол</th>
                        <th scope="col">Страна</th>
                        <th scope="col">Город</th>
                        <th scope="col">Пакет участия</th>
                        <th scope="col">Номер телефона</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td><img src="{{ asset('storage/images/' . $student->profile_image) }}" alt="" width="100"></td>
                            <td>
                                <strong>{{ $student->moderation}}</strong><br>
                                <input type="radio"
                                       name="moderation_yes"
                                       id="moderation_yes"
                                       value="1"
                                    {{ $student->moderation == '1' ? 'checked' : '' }}>
                                <label for="moderation_yes">Yes</label><br>
                                <input type="radio"
                                       name="moderation_no"
                                       id="moderation_no"
                                       value="0"
                                    {{ $student->moderation == '0' ? 'checked' : '' }}>
                                <label for="moderation_no">No</label><br>
                                <input type="radio"
                                       name="moderation"
                                       id="moderation"
                                       value="2"
                                    {{ $student->moderation == '2' ? 'checked' : '' }}>
                                <label for="moderation">Moderate</label>

                            </td>
                            <td>{{ \Carbon\Carbon::parse($student->birthday)->diffInYears() }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->country }}</td>
                            <td>{{ $student->city }}</td>
                            <td>{{ $student->name }}</td>
                            <td></td>
                            <td class="links-block">
                                <a href="{{ route('event_member_delete', ['id' => $student->id]) }}" class="btn btn-danger">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>


@endsection()

