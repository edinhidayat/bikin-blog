<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home',[
            'title' => 'My Blog',
            'posts' => Post::latest()->paginate(15)
        ]);
    }

    public function tampil($id)
    {
        return view('tampil',[
            'title' => 'Blog',
            'post' => Post::where('slug',$id)->get(),
            'posts' => Post::latest()->get()
        ]);
    }
}
