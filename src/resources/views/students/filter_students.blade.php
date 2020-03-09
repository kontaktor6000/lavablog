@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">
                <h2 style="margin-top: 10px">Фильтр пользователей</h2>

                <div>
                    <form action="{{ route('filter_students') }}" method="get">
                        <div class="form-group">
                            <label for="first_name" style="font-size: 22px;font-weight: bold">First Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="first_name"
                                   value="{{ request()->first_name }}">
                        </div>

                        <div class="form-group">
                            <label for="last_name" style="font-size: 22px;font-weight: bold">Last Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="last_name"
                                   value="{{ request()->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="account_tariff" style="font-size: 22px;font-weight: bold">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value=""></option>
                                <option value="man" {{ request()->gender == 'man' ? 'selected' : '' }}>Man</option>
                                <option value="woman" {{ request()->gender == 'woman' ? 'selected' : '' }}>Woman</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active" style="font-size: 22px;font-weight: bold">Is active</label><br>
                            <label for="is_active">Yes</label>
                            <input type="radio"
                                   name="is_active"
                                   id="is_active"
                                   value="1"
                                {{ request()->is_active == 1 ? 'checked' : '' }}>
                            <label for="is_active">No</label>
                            <input type="radio"
                                   name="is_active"
                                   id="is_not_active"
                                   value="0"
                                {{ !request()->is_active ? 'checked' : '' }}>
                        </div>


                        <div class="form-group">
                            <label for="account_type" style="font-size: 22px;font-weight: bold">Account Type</label><br>
                            <span style="padding-right: 10px">Fake</span><input type="checkbox"
                                   name="account_type_fake"
                                   value="fake"
                                {{ request()->account_type_fake == 'fake' ? 'checked' : '' }}>
                            <span style="padding-right: 10px">Real</span><input type="checkbox"
                                   name="account_type_real"
                                   value="real"
                                {{ request()->account_type_real == 'real' ? 'checked' : '' }}>
                        </div>



{{--                        <div class="form-group">
                            <label for="account_tariff" style="font-size: 22px;font-weight: bold">Account Tariff</label>
                            <select name="account_tariff" id="account_tariff" class="form-control">
                                <option value=""></option>
                                @foreach($accountTariffs as $accountTariff)
                                    <option value="{{ $accountTariff->id}}"
                                    @if($request->account_tariff == $accountTariff->id)
                                        selected
                                    @endif
                                    >{{ $accountTariff->name}}</option>
                                @endforeach
                            </select>
                        </div>--}}

                        <button class="btn btn-dark">Filter</button>
                    </form>
                </div>


                <div style="margin-top: 30px">
                    @foreach($students as $student)
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h5>
                                <p class="card-text">Tariff - {{ $student->accounttariff->name }}</p>
                                <p class="card-text">Gender - {{ $student->gender }}</p>
                                <p class="card-text">Is active - {{ $student->is_active ? 'Yes' : 'No' }}</p>
                                <p class="card-text">Account Type - {{ $student->account_type }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>



























                {{--            @if(count($errors) >  0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                                <img src="/images/{{ Session::get('path') }}" width="300" alt="">
                            @endif--}}

            </div>
        </div>
    </div>

@endsection()
