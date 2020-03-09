@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('widgets.left_menu')
            </div>
            <div class="col-md-9">

                <h2 style="margin-top: 10px">Список жалоб</h2>

                <table class="table">
                    @foreach($students as $student)
                    <tr>
                        <div class="row">
                            <div class="col-md-3">
                                <td>Жалоба от:</td>
                                <div class="col-md-6">
                                    <td><strong>{{ $student->a_first_name }} {{ $student->a_last_name }}</strong></td>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <td rowspan="3">{{ $student->peachDate }}<br>
                                                в {{ $student->peachTime }}<br>
                                                краткая суть:<br>
                                                <strong>{{ $student->shot_peach }}</strong>
                                </td>
                            </div>

                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <td>Жалоба на:</td>
                            <td><strong>{{ $student->b_first_name }} {{ $student->b_last_name }}</strong></td>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <td>Комментарий:</td>
                            <td>{{ $student->full_peach }}</td>
                        </div>
                    </tr>
                    <tr>
                        <div class="row">
                            <td colspan="2"><a href="{{ route('peach_delete', ['id' => $student->id]) }}" class="btn btn-danger">Delete</a></td>
                            <td></td>
                        </div>
                    </tr>
                    <tr style="height: 40px">

                    </tr>

                    @endforeach
                </table>


            </div>
        </div>
    </div>


@endsection()

