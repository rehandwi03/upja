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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// endpoint role
$router->get('/roles', 'RoleController@index');
$router->post('/roles', 'RoleController@store');
$router->put('/roles/{id}', 'RoleController@update');
$router->delete('/roles/{id}', 'RoleController@destroy');

// endpoint admin
$router->get('/admins', 'AdminController@index');
$router->post('/admins', 'AdminController@store');
$router->post('/admins/hide', 'AdminController@hide');

// endpoint user
$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@store');

// endpoint login
$router->post('/auth/login', 'AuthController@login');
