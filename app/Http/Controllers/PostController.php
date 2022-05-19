<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }
    
    public function store(Request $request)
    {
        $new_post = Post::create($request->all());
        return $new_post;
    }

    public function show(Post $post)
    {
        return $post;
    }
   
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return ['msg:' => 'The post has been deleted succefully'];
    }
}