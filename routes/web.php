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
    $respon = ["message" => "health"];
    return response()->json($respon, 200);
});
$router->group(
    ['middleware' => 'jwt.auth'],
    function () use ($router) {
        // endpoint trans journey
        $router->get('/transjourneys', 'TransJourneyController@index');
        $router->post('/transjourney', 'TransJourneyController@store');
        $router->patch('/transjourney/update/{id}', 'TransJourneyController@update');

        $router->group(['middleware' => 'admin'], function () use ($router) {
            // endpoint role
            $router->get('/roles', 'RoleController@index');
            $router->post('/role', 'RoleController@store');
            $router->patch('/role/update/{id}', 'RoleController@update');
            $router->patch('/role/hide/{id}', 'RoleController@role_hide');

            // endpoint admin
            $router->get('/admins', 'AdminController@index');
            $router->post('/admin', 'AdminController@store');
            $router->patch('/admin/hide/{id}', 'AdminController@hide');
            $router->patch('/admin/update/{id}', 'AdminController@update');

            // endpoint bank
            $router->get('/banks', 'BankController@index');
            $router->post('/bank', 'BankController@store');
            $router->patch('/bank/publish/{id}', 'BankController@bank_publish');
            $router->patch('/bank/hide/{id}', 'BankController@bank_hide');

            // endpoint province
            $router->get('/provinces', 'ProvinceController@index');
            $router->post('/province', 'ProvinceController@store');
            $router->patch('/province/hide/{id}', 'ProvinceController@province_hide');
            $router->patch('/province/update/{id}', 'ProvinceController@update');

            //endpoint district
            $router->get('/districts', 'DistrictController@index');
            $router->post('/district', 'DistrictController@store');
            $router->patch('/district/hide/{id}', 'DistrictController@district_hide');
            $router->patch('/district/update/{id}', 'DistrictController@update');

            // endpoint subdistrict
            $router->get('/subdistricts', 'SubdistrictController@index');
            $router->post('/subdistrict', 'SubdistrictController@store');
            $router->patch('/subdistrict/hide/{id}', 'SubdistrictController@subdistrict_hide');
            $router->patch('/subdistrict/update/{id}', 'SubdistrictController@update');

            // endpoint village
            $router->get('/villages', 'VillageController@index');
            $router->post('/village', 'VillageController@store');
            $router->patch('/village/hide/{id}', 'VillageController@village_hide');
            $router->patch('/village/update/{id}', 'VillageController@update');

            // endpoint farmer address
            $router->get('/faddress', 'FAddressController@index');
            $router->get('/faddress/show/{id}', 'FAddressController@id_farmer');
            $router->post('/faddress', 'FAddressController@store');

            // endpoint transport
            $router->get('/transports', 'TransportController@index');
            $router->post('/transport', 'TransportController@store');
            $router->patch('/transport/hide/{id}', 'TransportController@transport_hide');
            $router->patch('/transport/update/{id}', 'TransportController@update');

            // endpoint trans
            $router->get('/transactions', 'TransController@index');
            $router->post('/transaction', 'TransController@store');
            $router->patch('/transaction/status/{id}', 'TransController@trans_status');
        });

        // endpoint farmer
        $router->group(['middleware' => 'farmer'], function () use ($router) {
            $router->get('/farmers', 'FarmerController@index');
            $router->post('/farmer', 'FarmerController@store');
            $router->patch('/farmer/status/{id}', 'FarmerController@farmer_status');
            $router->patch('/farmer/hide/{id}', 'FarmerController@farmer_hide');
            $router->patch('/farmer/verify/{id}', 'FarmerController@verify_code');
        });

        // endpoint upja
        $router->group(['middleware' => 'upja'], function () use ($router) {
            // endpoint master upja
            $router->get('/upjas', 'UpjaController@index');
            $router->post('/upja', 'UpjaController@store');
            $router->patch('/upja/status/{id}', 'UpjaController@upja_status');
            $router->patch('/upja/verified/{id}', 'UpjaController@upja_verified');
            $router->patch('/upja/hide/{id}', 'UpjaController@upja_hide');

            // endpoint upja uom
            $router->get('/upja/uoms', 'UpjaUomController@index');
            $router->post('/upja/uom', 'UpjaUomController@store');
            $router->patch('/upja/uom/hide/{id}', 'UpjaUomController@uom_hide');
            $router->patch('/upja/uom/update/{id}', 'UpjaUomController@update');
        });
    }
);
