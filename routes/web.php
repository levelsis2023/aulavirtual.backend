<?php

use Illuminate\Support\Facades\Route;

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


$router->group(['prefix' => '{domain}/api', 'middleware' => ['validate.domain', 'cors']], function () use ($router) {
    $router->get('test', function(){
        dd(1);
    });
    $router->get('maestros', 'MaestroController@index');
    $router->post('maestros', 'MaestroController@store');
    $router->get('maestros/{id}', 'MaestroController@show');
    $router->put('maestros/{id}', 'MaestroController@update');
    $router->delete('maestros/{id}', 'MaestroController@destroy');

    $router->get('parametros', 'ParametroController@index');
    $router->post('parametros', 'ParametroController@store');
    $router->get('parametros/{id}', 'ParametroController@show');
    $router->put('parametros/{id}', 'ParametroController@update');
    $router->delete('parametros/{id}', 'ParametroController@destroy');

    $router->get('carreras', 'CarreraController@index');
    $router->post('carreras', 'CarreraController@store');
    $router->get('carreras/{id}', 'CarreraController@show');
    $router->put('carreras/{id}', 'CarreraController@update');
    $router->delete('carreras/{id}', 'CarreraController@destroy');

    $router->get('aula-virtual/configuracion/instituciones', 'InstitucionesController@index');
    $router->post('aula-virtual/configuracion/instituciones', 'InstitucionesController@store');
    $router->get('aula-virtual/configuracion/instituciones/{id}', 'InstitucionesController@show');
    $router->put('aula-virtual/configuracion/instituciones/{id}', 'InstitucionesController@update');
    $router->delete('aula-virtual/configuracion/instituciones/{id}', 'InstitucionesController@destroy');

    
});
