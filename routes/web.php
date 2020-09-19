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

$router->group(['middleware' => 'client.credentials'], function() use ($router){

 

    $router->get('/authors', 'Author\AuthorController@index');
    $router->post('/authors', 'Author\AuthorController@store');
    $router->get('/authors/{author}', 'Author\AuthorController@show');
    $router->put('/authors/{author}', 'Author\AuthorController@update');
    $router->patch('/authors/{author}', 'Author\AuthorController@update');
    $router->delete('/authors/{author}', 'Author\AuthorController@destroy');

    $router->get('/books', 'Book\BookController@index');
    $router->post('/books', 'Book\BookController@store');
    $router->get('/books/{book}', 'Book\BookController@show');
    $router->put('/books/{book}', 'Book\BookController@update');
    $router->patch('/books/{book}', 'Book\BookController@update');
    $router->delete('/books/{book}', 'Book\BookController@destroy');


    //POSTS API ROUTES
    $router->get('/posts', 'Post\PostController@index');
    $router->post('/posts', 'Post\PostController@store');
    $router->get('/posts/{post}', 'Post\PostController@show');
    $router->put('/posts/{post}', 'Post\PostController@update');
    $router->patch('/posts/{post}', 'Post\PostController@update');
    $router->delete('/posts/{post}', 'Post\PostController@destroy');


    //PRODUCTS API ROUTES
    $router->get('/products',         'Product\ProductController@index');
    $router->post('/products',          'Product\ProductController@store');
    $router->get('/products/{product}',   'Product\ProductController@show');
    $router->put('/products/{product}',    'Product\ProductController@update');
    $router->patch('/products/{product}',    'Product\ProductController@update');
    $router->delete('/products/{product}',     'Product\ProductController@destroy');

});


$router->post('/register','UserController@register');
$router->post('/login','UserController@login');