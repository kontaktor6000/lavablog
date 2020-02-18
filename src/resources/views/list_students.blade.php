@extends('layouts.app')
@section('content')

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Middle</th>
                        <th scope="col">Last</th>
                        <th scope="col">Add Hooky</th>
                        <th scope="col">Absents Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->middle_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td><a href="{{ route('add_absent', $student->id) }}" type="submit" class="btn btn-dark" name="absent">Add absent</a></td>
                            <td>
                                <ul>
                                    @foreach($student->absents  as $absent)
                                        <li>{{ $absent->date }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <a href="{{ route('add_students') }}" class="btn btn-dark" >Add student</a>
            </div>

        </div>
    </div>


@endsection()
