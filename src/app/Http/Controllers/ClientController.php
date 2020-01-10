<?php

namespace App\Http\Controllers;

use App\Http\Models\City;
use App\Http\Models\Client;
use App\Http\Models\Country;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClients()
    {
        $clients = Client::all();
        //dd($clients);

        return view('default.show_all_clients', ['clients' => $clients]);
    }

    public function showAddForm()
    {
        $countries = Country::all();
        $cities = City::all();
        //dd($cities);

        return view('default.show_form_add_client', ['countries' => $countries, 'cities' => $cities]);
    }

    public function store(Request $request) {
        //dd($request);

        $client = new Client();

        $client->name = $request->name;
        $client->avatar = $request->file('avatar')->store('uploads', 'public');
        $client->date_of_birth = date("Y-m-d", strtotime($request->date_of_birth));
        $client->gender = $request->gender;
        //$client->country = $request->country;
        $client->city_id = $request->city_id;
        $client->description = $request->description;

        //dd($client);

        $client->save();

        return redirect('/all-clients');

    }

}
