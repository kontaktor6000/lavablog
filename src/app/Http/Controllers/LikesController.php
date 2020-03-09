<?php

namespace App\Http\Controllers;

use App\Like;
use App\Student;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index($id)
    {
        $likes = Like::with('students');;
        $likes = $likes->get();

        //dd($likes);

        $student = Student::find($id);

        return view('likes.likes_list', [
            'likes' => $likes,
            'student' => $student,
        ]);
    }
}
