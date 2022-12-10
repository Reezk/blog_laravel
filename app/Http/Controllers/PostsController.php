<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    public function index()
    {

        return view('blog.index')->with('posts', Post::orderBy('title', 'DESC')->get());
    }
    public function create()
    {
        return view('blog.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'discription' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);


        $slug = Str::slug($request->title, '-');

        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $post =  Post::create([
            'title' => $request->input('title'),
            'discription' => $request->input('discription'),
            'slug' => $slug,
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id,
        ]);
        //$post->save();
        //dd($slug);

        return redirect('/blog');
    }

    public function show($slug)
    {
        return view('blog.show')->with('post', Post::where('slug', $slug)->first());
    }

    public function edit($slug)
    {
        return view('blog.edit')->with('post', Post::where('slug', $slug)->first());
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'discription' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);


        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $post =  Post::where('slug', $slug)->update([
            'title' => $request->input('title'),
            'discription' => $request->input('discription'),
            'slug' => $slug,
            //'image_path' => $newImageName,
            'user_id' => auth()->user()->id,
        ]);
        return redirect('/blog/' . $slug)->with('message', 'Edit success');
    }


    public function destroy($slug)
    {
        Post::where('slug', $slug)->delete();
        return redirect('/blog')->with('message', 'Delete success');
    }
}
