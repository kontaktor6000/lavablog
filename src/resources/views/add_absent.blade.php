@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div><br />
                @endif
                <h2>Добавление даты пропуска занятий</h2><br/>
                <form method="post" action="{{url('add_absent')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Full name</label>
                        <input type="text" class="form-control" name="full_name" id="full_name">
                        <input type="hidden" name="id_student" id="id_student">
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="date form-control" name="date" id="date">
                    </div>

                    <div class="form-group" style="margin-top:60px">
                        <button type="submit" class="btn btn-dark">Добавить дату пропуска</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection()
