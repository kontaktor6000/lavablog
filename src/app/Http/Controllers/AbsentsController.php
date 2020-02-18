<?php

namespace App\Http\Controllers;

use App\Absent;
use Illuminate\Http\Request;

class AbsentsController extends Controller
{
    protected $table = 'absents';

    public function index()
    {
        $absents = new Absent();
    }


    public function create($id)
    {
        $id = $;
        return view('/create_absent',
            [
                'id' => $id,
            ]
        );
    }

    public function addAbsent(Request $request)
    {
        dd($request);
        $absent = new Absent();
        $absent->id_student = $request->get('id_student');
        $absent->date = $request->get('date');
        $absent->save();
        return redirect('add_absent')->with('success', 'Name and Date has been added in database');
    }
}
