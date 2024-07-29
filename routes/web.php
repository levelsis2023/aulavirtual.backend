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

$router->group(['prefix' => 'api/{domain}', 'middleware' => ['validate.domain']], function () use ($router) {

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

    $router->get('instituciones', 'InstitucioneController@index');
    $router->post('instituciones', 'InstitucioneController@store');
    $router->get('instituciones/{id}', 'InstitucioneController@show');
    $router->put('instituciones/{id}', 'InstitucioneController@update');
    $router->delete('instituciones/{id}', 'InstitucioneController@destroy');

    $router->get('carreras', 'CarreraController@index');
    $router->post('carreras', 'CarreraController@store');
    $router->get('carreras/{id}', 'CarreraController@show');
    $router->put('carreras/{id}', 'CarreraController@update');
    $router->delete('carreras/{id}', 'CarreraController@destroy');


    $router->get('cursos', 'CursoController@index');
    $router->post('cursos', 'CursoController@store');
    $router->get('cursos/{id}', 'CursoController@show');
    $router->put('cursos/{id}', 'CursoController@update');
    $router->delete('cursos/{id}', 'CursoController@destroy');

    $router->get('roles', 'RolController@index');
    $router->post('rol/guardar', 'RolController@store');
    $router->get('rol/{id}', 'RolController@show');
    $router->put('rol/guardar/{id}', 'RolController@update');
    $router->delete('rol/eliminar/{id}', 'RolController@destroy');

    $router->post('rol/guardar-permiso', 'RolController@guardarPermiso');
    $router->get('rol/get-rol-permiso/{id}', 'RolController@getRolPermisos');
    
    $router->get('empresas', 'EmpresaController@index');
    $router->post('empresa/guardar', 'EmpresaController@store');
    $router->get('empresa/{id}', 'EmpresaController@show');
    $router->put('empresa/guardar/{id}', 'EmpresaController@update');
    $router->delete('empresa/eliminar/{id}', 'EmpresaController@destroy');

    $router->get('permisos', 'PermisoController@index');
    $router->post('permiso/guardar', 'PermisoController@store');

});


