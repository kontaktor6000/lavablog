@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8"><h2>Создание реферального кода</h2></div>
                    <div class="col-md-4">
                        <a href="{{ route('referral_codes_list') }}" class="btn btn-dark">Список реферальных кодов</a>
                    </div>
                </div>

                <div>
                    <h5>Новый реферальный код</h5>
                    <p style="font-size: 22px"><strong>{{ $randomReferralCode }}</strong></p>
                    <h5>Выберите тарифный план</h5>
                    <form class="" method="post" action="{{ route('referral_code_store') }}">
                        @csrf

                        <select name="trial_period_group_id" id="trial_period_group_id"  class="form-control">
                            @foreach($trialPeriodGroups as $trialPeriodGroup)
                                <option value="{{ $trialPeriodGroup->id }}">
                                    <strong>{{ $trialPeriodGroup->name }}</strong> -  {{ $trialPeriodGroup->trial_period }} дней триального тарифа
                                </option>
                            @endforeach
                                <input type="hidden" name="referral_code" value="{{ $randomReferralCode }}">
                        </select>
                        <br>
                        <input type="submit" class="btn btn-dark" value="Save Referral Code">
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>


@endsection()

