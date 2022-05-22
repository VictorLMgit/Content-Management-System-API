<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // O método construror injeta uma instância do Model para usa-lo como um objeto de forma mais maleável.
    public function __construct(Post $post){
        $this->post = $post;
    }

    /* O método index serve simplesmente para retornar ao usuário todas as postagens registradas no DB.
    Se houver na requisição um parâmetro 'tag' como ?tag=valor, a função irá retornar todas as postagem 
    que contiverem este valor em seu array de Tags. */
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
    

    /* O método store checa se a requisição enviada pelo cliente é válida, ou seja, se possui
    o campo 'title' e se esse campo não é repetido. Se a checagem for validada, o método armazena
    o registro no DB, senão, é retornado um erro para o cliente */
    public function store(Request $request)
    {

        $request->validate($this->post->rules());
        $new_post = $this->post->create($request->all());
        $new_post = $this->post->select('title', 'author', 'content', 'tags','id')->where('id','=',$new_post->id)->get();
        return response()->json($new_post,201);
        // dd($request->all());
    }

    /* O método show apenas retorna para o cliente uma postagem especificada pelo id,
    caso o id não esteja registrado no banco de dados, é retornado um json informando que a rota 
    não foi encontrada */
    public function show($id)
    {
        $post = $this->post->find($id);
        if ($post === null)
        {
            return response()->json(['error:'=>'Route not found'],404);
        }
        $post = $this->post->select('id','title', 'author', 'content', 'tags')->where('id','=',$id)->get();
        return $post;
    }
   
    /* O método update identifica um registro no BD através do id e o atualiza no BD a partir do que foi
    enviado na requisição pelo cliente, caso essa requisição seja validada */
    public function update(Request $request, $id)
    {
        $post = $this->post->find($id);
        if ($post === null)
        {
            return response()->json(['error:'=>'Route not found. Update failed'],404);
        }

        // Regras parciais de validação para filtrar a validação apenas para os campos que serão editados.
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

    /* O método destroy deleta uma postagem especificada pelo id.
    caso o id não esteja registrado no banco de dados, é retornado um json informando que a rota 
    não foi encontrada */
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