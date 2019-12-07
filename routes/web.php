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

$router->get('/', 'DomainController@index');

$router->get('/domains', 'DomainController@showAll');

$router->post('/domains', 'DomainController@create');

$router->get('/domains/{id}', ['as' => 'domainId', 'uses' => 'DomainController@showId']);
