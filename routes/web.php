<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use Illuminate\Http\Response;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('auth', 'AuthController@authenticate');

$router->group(['middleware'=>'jwt.auth'], function() use ($router){
    $router->group(['prefix'=> 'api'], function() use ($router){
        $router->post('author', 'Author@insert');
        $router->get('author', 'Author@getAll');
        $router->get('author/post', 'Author@GetAllPost');
        $router->get('author/comment', 'Author@GetAllComment');
        $router->patch('author/{id}', 'Author@update');
        $router->get('author/{id}', 'Author@getById');
        $router->delete('author/{id}', 'Author@delete');
    
        $router->post('post', 'Post@insert');
        $router->get('post', 'Post@getAll');
        $router->get('post/author', 'Post@getPostAuthor');
        $router->get('post/author/{id}', 'Post@getPostAuthorId');
        $router->patch('post/{id}', 'Post@update');
        $router->get('post/{id}', 'Post@getById');
        $router->delete('post/{id}', 'Post@delete');
    
        $router->post('comment', 'Comment@insert');
        $router->get('comment', 'Comment@getAll');
        $router->patch('comment/{id}', 'Comment@update');
        $router->get('comment/{id}', 'Comment@getById');
        $router->delete('comment/{id}', 'Comment@delete');
    });
});

