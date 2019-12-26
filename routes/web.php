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

$router->get('/', ['as' => 'home', 'uses' => 'HomePageController@home']);

$router->get('/domains', ['as' => 'domains.index', 'uses' => 'DomainController@index']);

$router->post('/domains', ['as' => 'domains.analysis', 'uses' => 'DomainController@analyze']);

$router->get('/domains/{id}', ['as' => 'domains.show', 'uses' => 'DomainController@show']);
