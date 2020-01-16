<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckUserServer;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
/*
    public $title;
    public $content;*/

    public function show()
    {
        $hostName = new CheckUserServer();
        return view('add_post', ['hostName' => $hostName]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $post= new Post;
        $post->title = $request->title;
        $post->content = $request->text;
        $post->user_id = Auth::user()->id;

        $post->save();
        return view('add_post');
    }

}
