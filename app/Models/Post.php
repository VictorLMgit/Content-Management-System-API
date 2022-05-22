<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','author','content','tags'];

    protected $casts = [
        "tags" => "array"
    ];
    // post_id = null para quando o id não for passado, as regras serem aplicadas para todas as linhas da tabela
    public function rules($post_id = null){
        //unique:tabela,coluna que será trabalhada na tabela,linha que será desconsiderada na busca.
        return [
            'title' => 'required|unique:posts,title,'.$post_id, 
            'author' => 'required',
        ];
    }
}