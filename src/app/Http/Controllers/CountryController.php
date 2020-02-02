<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::get();
        //dd($countries->random()->id);

        return view('countries.countries_list', compact('countries'));
    }
}
