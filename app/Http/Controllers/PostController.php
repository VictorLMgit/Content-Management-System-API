<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(Post $post){
        $this->post = $post;
    }
    public function index()
    {
        // $posts = Post::all(); Método estático
        $posts = $this->post->all();
        return $posts;
    }
    
    public function store(Request $request)
    {
        $new_post = $this->post->create($request->all());
        return $new_post;
    }

    // Recebe um inteiro id e pesquiso ele entre meus itens armazenados
    public function show($id)
    {
        $post = $this->post->find($id);
        if ($post === null){
            return ['error:'=>'Route not found'];
        }
        return $post;
    }
   
    public function update(Request $request, $id)
    {
        $post = $this->post->find($id);
        if ($post === null){
            return ['error:'=>'Route not found. update failed'];
        }
        $post->update($request->all());
        return $post;
    }

    public function destroy($id)
    {
        $post = $this->post->find($id);
        if ($post === null){
            return ['error:'=>'Route not found. delete failed'];
        }
        $post->delete();
        return ['msg:' => 'The post has been deleted succefully'];
    }
}