@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <div class="btn-group col-12 no-gutters "
                     role="group">
                    <a href="{{ route('add_students') }}" class="btn btn-primary btn-block" aria-pressed="true">Добавить студента</a>
                    <a href="{{ route('filter_students') }}" class="btn btn-primary btn-block m-0" aria-pressed="true">Фильтр</a>
                    <a href="{{ route('download_students') }}" class="btn btn-primary btn-block m-0" aria-pressed="true">Выгрузить в Excel</a>
                </div>
                <h2 style="margin-top: 20px">Список студентов</h2>

                {{--@foreach($students->pivot->events as $item)
                    {{ dd($item) }}
                @endforeach--}}

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Тип аккаунта</th>
                        <th scope="col">Дата регистрации</th>
                        <th scope="col">Дата последней активности</th>
                        <th scope="col">Реферальный код приглашения</th>
                        <th scope="col">Тип тарифа</th>
                        <th scope="col">Действия</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>
                                <a href="{{ route('show_student', $student->id) }}" class="btn btn-primary">
                                    {{ $student->first_name }}<br>{{ $student->middle_name }}<br>{{ $student->last_name }}
                                </a>
                            </td>
                            <td><img src="{{ asset('storage/images/' . $student->profile_image) }}" alt="" width="100"></td>
                            <td>{{ $student->account_type }}</td>
                            <td>{{ $student->created_at }}</td>
                            <td>{{ $student->updated_at }}</td>
                            <td>
                                @isset($student->referralcode->referral_code)
                                    {{ $student->referralcode->referral_code }}
                                @endisset
                            </td>
                            <td>{{ $student->accounttariff->name }} {{ $student->accounttariff->id }}</td>
                            <td class="links-block">
                                <a href="{{ route('likes_list', ['id' => $student->id]) }}" class="btn btn-primary">Лайки</a>
                                @if($student->is_active == 1)
                                <a href="{{ route('not_active_student', ['id' => $student->id]) }}" class="btn btn-dark">Заблокировать</a>
                                @else
                                <a href="{{ route('active_student', ['id' => $student->id]) }}" class="btn btn-success">Активировать</a>
                                @endif
                                <a href="{{ route('delete_student', ['id' => $student->id]) }}" class="btn btn-danger">Удалить</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>

                {{--{{ $students->links() }}--}}

                <a href="{{ route('add_students') }}" class="btn btn-dark" >Добавить студента</a>
            </div>
        </div>
    </div>


@endsection()
