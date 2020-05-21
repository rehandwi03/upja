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
// endpoint auth
$router->post('/auth/login', 'AuthController@login');
$router->get('/health', function () {
    return "200 OK";
});

$router->group(
    ['middleware' => 'jwt.auth'],
    function () use ($router) {
        $router->group(['middleware' => 'admin'], function () use ($router) {
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

        // endpoint farmer

        $router->get('/farmers', 'FarmerController@index');
        $router->post('/farmers', 'FarmerController@store');
        $router->patch('/farmers/status/{id}', 'FarmerController@farmer_status');
        $router->patch('/farmers/hide/{id}', 'FarmerController@farmer_hide');
    }
);
