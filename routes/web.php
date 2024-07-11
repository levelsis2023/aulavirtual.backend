<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('maestros', 'MaestroController@index');
    $router->post('maestros', 'MaestroController@store');
    $router->get('maestros/{id}', 'MaestroController@show');
    $router->put('maestros/{id}', 'MaestroController@update');
    $router->delete('maestros/{id}', 'MaestroController@destroy');

});
