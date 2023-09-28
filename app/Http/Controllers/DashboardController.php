<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard | Post',
            'posts' => Post::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'judul' => 'required|max:200',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
            'thumb' => 'image|file|max:2048',
            'banner' => 'image|file|max:2048'
        ]);

        if ($request->file('thumb')) {
            $validated['thumb'] = $request->file('thumb')->store('public/thumb');
        }
        if ($request->file('banner')) {
            $validated['banner'] = $request->file('banner')->store('public/banner');
        }

        Post::create($validated);
        return redirect('/dashboard')->with('suksestambah', 'Data Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        return view('ubah',[
            'title' => 'Ubah Blog',
            'post' => Post::find($post)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $post = Post::find($post);
        
        $rules = [
            'user_id' => 'required',
            'judul' => 'required|max:200',
            'body' => 'required',
            'thumb' => 'image|file|max:2048',
            'banner' => 'image|file|max:2048'
        ];

        if($post->slug != $request->slug){
            $rules['slug'] = 'required|unique:posts,slug';
        }
        $rules['slug'] = 'required';

        $validated = $request->validate($rules);

        if ($request->file('thumb')) {
            if ($request->oldThumb) {
                Storage::delete($request->oldThumb);
            }
            $validated['thumb'] = $request->file('thumb')->store('public/thumb');
        }

        if ($request->file('banner')) {
            if ($request->oldBanner) {
                Storage::delete($request->oldBanner);
            }
            $validated['banner'] = $request->file('banner')->store('public/banner');
        }

        Post::where('id', $post->id)
                ->update($validated);
        return redirect('/dashboard')->with('suksesubah', 'Data Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post = Post::find($post);
        if ($post->thumb) {
            Storage::delete($post->thumb);
        }
        if ($post->banner) {
            Storage::delete($post->banner);
        }
        Post::destroy($post->id);
        return redirect('/dashboard')->with('sukseshapus', 'Data Berhasil dihapus!');
    }
}
