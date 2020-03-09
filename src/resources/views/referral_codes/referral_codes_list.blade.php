@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8"><h2>Список реферальных кодов</h2></div>
                    <div class="col-md-4">
                        <a href="{{ route('referral_code_create') }}" class="btn btn-dark">Создать реферальный код</a>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Реферальный код</th>
                        <th scope="col">Кол-во дней бесплатного тарифа</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($referralCodes as $referralCode)
                        <tr>
                            <td>{{ $referralCode->id }}</td>
                            <td>{{ $referralCode->referral_code}}</td>
                            <td>{{ $referralCode->trialperiodgroup->trial_period }}</td>
                            <td>
                                <a href="{{ route('referral_code_delete', [$referralCode->id]) }}" class="btn btn-danger">Удалить</a>
                                <a href="{{ route('referral_code_edit', [$referralCode->id]) }}" class="btn btn-secondary">Редактировать</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>

                <a href="{{ route('add_students') }}" class="btn btn-dark" >Добавить студента</a>
            </div>
        </div>
    </div>


@endsection()
