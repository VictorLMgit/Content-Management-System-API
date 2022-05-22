<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Criação de todas as rotas necessárias para a API

Método   URI
-------------------------
GET      api/posts
POST     api/posts
GET      api/posts/{id}
PUT      api/posts/{id}
DELETE   api/posts/{id}

e apontando para o PostController */
Route::apiResource('posts', 'App\Http\Controllers\PostController');