<?php

namespace App\Http\Controllers;

use App\Absent;
use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public function index()
    {
        $students = new Student();
        $students = $students->get();

        $absents = new Absent();

        $absents = $absents->get();

        //dd($absents);

        return view('/list_students', [
            'students' => $students,
            'absents'  => $absents,
        ]);
    }

    public function add()
    {
        return view('add_students');
    }

    public function store(Request $request)
    {
        $student = new Student();

        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;

        $student->save();

        return redirect('/list_students');

    }
}
