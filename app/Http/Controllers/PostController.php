<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(Post $post){
        $this->post = $post;
    }

    public function index(Request $request)
    {   
    
        if($request->has('tag'))
        {
            $tag = $request->tag;
            
            $posts = $this->post->select('id', 'title', 'author', 'content', 'tags')->where('tags','like',"%$tag%")->get();
            return response()->json($posts,200);
        }
        else
        {
            $posts = $this->post->select('id', 'title', 'author', 'content', 'tags')->get();
            return response()->json($posts,200);
        }
    }
    
    public function store(Request $request)
    {

        $request->validate($this->post->rules());
        $new_post = $this->post->create($request->all());
        return response()->json($new_post,201);
    }

    // Recebe um inteiro id e pesquiso ele entre meus itens armazenados
    public function show($id)
    {
        $post = $this->post->find($id);
        if ($post === null)
        {
            return response()->json(['error:'=>'Route not found'],404);
        }
        return $post;
    }
   
    public function update(Request $request, $id)
    {
        $post = $this->post->find($id);
        if ($post === null)
        {
            return response()->json(['error:'=>'Route not found. Update failed'],404);
        }

        // Regras parciais para filtrar os campos que serão editados.
        $partial_rules = array();

        foreach($this->post->rules($id) as $input => $rule)
        {
            if(array_key_exists($input, $request->all()))
            {
                $partial_rules[$input] = $rule;
            }
        }

        $request->validate($partial_rules);
        $post->update($request->all());
        $post = $this->post->select('title', 'author', 'content', 'tags','id')->where('id','=',$id)->get();
        return response()->json($post,200);
    }

    public function destroy($id)
    {
        $post = $this->post->find($id);
        if ($post === null)
        {
            return response()->json(['error:'=>'Route not found delete failed'],404);
        }
        $post->delete();
        return response()->json(['msg:' => 'The post has been deleted succefully'],200);
    }
}