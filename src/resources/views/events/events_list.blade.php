@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-10">
                <div class="btn-group col-12 no-gutters" role="group">
                    <a href="{{ route('event_add') }}" class="btn btn-dark" >Добавить мероприятие</a>
                </div>
                <h2 style="margin-top: 20px">Список мероприятий</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Дата начала</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Время начала</th>
                        <th scope="col">Время окончания</th>
                        <th scope="col">До мероприятия осталось<br>
                                        (месяцы/дни/часы)</th>
                        <th scope="col">Страна</th>
                        <th scope="col">Действие</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>
                                <a href="{{ route('event_show', $event->id) }}" class="btn btn-primary">
                                    {{ $event->event_name }}
                                </a>
                            </td>
                            <td><img src="{{ asset('storage/images/events/' . $event->event_image_preview) }}" alt="" width="150"></td>
                            <td>{{ $event->begin_date }}</td>
                            <td>{{ $event->end_date }}</td>
                            <td>{{ $event->begin_time }}</td>
                            <td>{{ $event->end_time }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->begin_date)
                                                    ->addHours(\Carbon\Carbon::parse($event->begin_time)->diffInHours('00:00:00'))
                                                    ->diff(\Carbon\Carbon::now())
                                                     ->format('%y years, %m months %d days and %h hours') }}</td>
                            <td>{{ $event->country->name }}</td>
                            <td class="links-block">
                                <a href="{{ route('event_members_list', ['id' => $event->id]) }}" class="btn btn-primary">Список участников</a>
                                <a href="{{ route('event_delete', ['id' => $event->id]) }}" class="btn btn-danger">Удалить</a>
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

