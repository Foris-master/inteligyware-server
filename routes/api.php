<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['namespace'=>'App\Api\V1\Controllers'],function (Router $api){

        $api->group(['prefix' => 'auth'], function(Router $api) {
            $api->post('signin', 'Auth\AuthController@login');
            $api->post('signup', 'Auth\AuthController@postRegister');
            $api->post('send-code', 'Auth\AuthController@sendPhoneVerificationCode');
            $api->post('verify-code', 'Auth\AuthController@verifyCode');
            $api->get('refresToken', 'Auth\AuthController@refresToken');
        });

        $api->group(['prefix' => 'auth','middleware' => 'jwt.auth'], function(Router $api) {

            $api->post('logout', 'LogoutController@logout');
            $api->post('refresh', 'RefreshController@refresh');
            $api->get('me', 'Auth\AuthController@getAuthenticatedUser');
        });

        $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
            $api->group(['prefix' => 'users'], function(Router $api) {
                $api->get('me', 'UserController@me');
                $api->post('updateMe', 'Auth\AuthController@updateMe');

            });

            $api->resource("addresses", 'AddressController');
            $api->resource("bills", 'BillController');
            $api->resource("client_offers", 'ClientOfferController');
            $api->resource("clients", 'ClientController');
            $api->resource("countries", 'CountryController');
            $api->resource("currencies", 'CurrencyController');
            $api->resource("devices", 'DeviceController');
            $api->resource("mobile_operators", 'MobileOperatorController');
            $api->resource("offers", 'OfferController');
            $api->resource("permissions", 'PermissionController');
            $api->resource("patners", 'PatnerController');
            $api->resource("point_of_sales", 'PointOfSaleController');
            $api->resource("point_of_sale_services", 'PointOfSaleServiceController');
            $api->resource("payments", 'PaymentController');
            $api->resource("ratings", 'RatingController');
            $api->resource("roles", 'RoleController');
            $api->resource("services", 'ServiceController');
            $api->resource("service_stations", 'ServiceStationController');
            $api->resource("stations", 'StationController');
            $api->resource("subscriptions", 'SubscriptionController');
            $api->resource("subscription_users", 'SubscriptionUserController');
            $api->resource("towns", 'TownController');
            $api->resource("transactions", 'TransactionController');
            $api->resource("users", 'UserController');

        });
    });
});