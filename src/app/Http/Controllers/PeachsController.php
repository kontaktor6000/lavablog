<?php

namespace App\Http\Controllers;

use App\Peach;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeachsController extends Controller
{
    public function index()
    {
        $peachs = Peach::with('students');
        $peachs = $peachs->get();

        return view('peachs.peachs_list', compact('peachs'));
    }

    public function delete($id)
    {

    }

}
