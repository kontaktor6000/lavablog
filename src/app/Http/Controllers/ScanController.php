<?php

namespace App\Http\Controllers;

use App\Scaner;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function scan()
    {
        return view('scanbook.scaner', []);
    }


}
