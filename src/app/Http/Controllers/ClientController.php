<?php

namespace App\Http\Controllers;

use App\Http\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function showAddForm()
    {
        return view('default.show_form_add_client');
    }

    public function store(Request $request) {

        $client = new Client();

        $client->name = $request->name;
        $client->avatar = $request->avatar;
        $client->day_of_birth = $request->day_of_birth;
        $client->gender = $request->gender;
        $client->country = $request->country;
        $client->city = $request->city;
        $client->description = $request->description;

        $client->save();

    }

}
