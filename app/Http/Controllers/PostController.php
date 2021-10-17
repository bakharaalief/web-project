<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return View('post.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validates = $request->validate(
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );

        if ($validates) {
            Post::create([
                'title' => $request['title'],
                'body' => $request['body']
            ]);

            return redirect(route('blog.index'));
        } else return redirect(route('blog.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validates = $request->validate(
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );

        if ($validates) {
            Post::where('id', $id)->update([
                'title' => $request['title'],
                'body' => $request['body']
            ]);

            return redirect(route('blog.index'));
        } else return redirect(route('blog.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect(route('blog.index'));
    }
}
