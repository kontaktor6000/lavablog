<?php

namespace App\Http\Controllers;

use App\Owner;
use App\PublishingHouse;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::get();
        $publishingHouses = PublishingHouse::get();

        return view('owners.owners_list', [
            'owners' => $owners,
            'publishingHouses' => $publishingHouses,
        ]);
    }
}
