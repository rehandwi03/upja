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
            // endpoint role
            $router->get('/roles', 'RoleController@index');
            $router->post('/role', 'RoleController@store');
            $router->patch('/role/{id}', 'RoleController@update');
            $router->delete('/role/{id}', 'RoleController@destroy');

            // endpoint admin
            $router->get('/admins', 'AdminController@index');
            $router->post('/admin', 'AdminController@store');
            $router->patch('/admin/hide/{id}', 'AdminController@hide');

            $router->group(['middleware' => 'farmer'], function () use ($router) {
                // endpoint farmer
                $router->get('/farmers', 'FarmerController@index');
                $router->post('/farmer', 'FarmerController@store');
                $router->patch('/farmer/status/{id}', 'FarmerController@farmer_status');
                $router->patch('/farmer/hide/{id}', 'FarmerController@farmer_hide');
                $router->patch('/farmer/verify/{id}', 'FarmerController@verify_code');
            });
            $router->group(['middleware' => 'upja'], function () use ($router) {
                // endpoint upja
                $router->get('/upjas', 'UpjaController@index');
                $router->post('/upja', 'UpjaController@store');
                $router->patch('/upja/status/{id}', 'UpjaController@upja_status');
                $router->patch('/upja/verified/{id}', 'UpjaController@verified');
                $router->patch('/upja/hide/{id}', 'UpjaController@upja_hide');
            });
        });
    }
);
