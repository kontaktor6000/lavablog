<?php

namespace App\Http\Controllers;


use App\Http\Models\Parfume;
use Illuminate\Http\Request;

class ParfumeController extends Controller
{

    public function indexAction()
    {
        return view('parfume', ['name' => 'Petro']);
    }

    public function getDataAction(Request $requests)
    {
        $name = $requests->name;
        $slug = $requests->slug;
        $description = $requests->description;
        $big_img = $requests->file('big_icon');
        $small_img = $requests->file('small_icon');
        $id_category = $requests->category;


        $parfume = new Parfume;
        $parfume->name = $name;
        $parfume->slug= $slug;
        $parfume->description = $description;
        $parfume->big_img= $big_img;
        $parfume->small_img = $small_img;
        $parfume->id_category = $id_category;
        $parfume->save();


    }
}
