<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['namespace'=>'App\Api\V1\Controllers'],function (Router $api){

        $api->group(['prefix' => 'auth'], function(Router $api) {
            $api->post('login', 'Auth\AuthController@loginWithPhoneNumberAndPinCode');
            /*$api->post('signup', 'Auth\AuthController@postRegister');*/
            $api->post('signup', 'Auth\AuthController@postRegisterWithPhoneNumber');
            $api->post('send-code', 'Auth\AuthController@sendPhoneVerificationCode');
            $api->post('verify-code', 'Auth\AuthController@verifyCode');
            $api->get('me', 'Auth\AuthController@getAuthenticatedUser');
            $api->get('refresToken', 'Auth\AuthController@refresToken');
        });

        $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
            $api->group(['prefix' => 'users'], function(Router $api) {
                $api->get('me', 'UserController@me');
                $api->post('updateMe', 'Auth\AuthController@updateMe');
                $api->post('set-pin-code', 'Auth\AuthController@setPinCode');
            });

            $api->resource("answers", 'AnswerController');
            //$api->resource("persons", 'PersonController');
            $api->resource("phone_numbers", 'PhoneNumberController');

            $api->resource("addresses", 'AddressController');
            $api->resource("bank_accounts", 'BankAccountController');
            $api->resource("beneficiaries", 'BeneficiaryController');
            $api->resource("communities", 'CommunityController');
            $api->resource("community_users", 'CommunityUserController');
            $api->resource("credit_cards", 'CreditCardController');
            $api->resource("devices", 'DeviceController');
            $api->resource("memos", 'MemoController');
            $api->resource("mobile_operators", 'MobileOperatorController');
            $api->resource("payment_methods", 'PaymentMethodController');
            $api->resource("permissions", 'PermissionController');
            $api->resource("persons", 'PersonController');
            $api->resource("personal_documents", 'PersonalDocumentController');
            $api->resource("questions", 'QuestionController');
            $api->resource("ratings", 'RatingController');
            $api->resource("roles", 'RoleController');
            $api->resource("towns", 'TownController');
            $api->resource("users", 'UserController');
            $api->resource("verifications", 'VerificationController');
            $api->resource("offers", 'OfferController');
            $api->resource("transfert_reasons", 'TransfertReasonController');
            $api->resource("competitors", 'CompetitorController');
            $api->resource("competitor_rates", 'CompetitorRateController');

            $api->resource("matches", 'MatchController');
            $api->resource("match_proposals", 'MatchProposalController');
            $api->resource("bills", 'BillController');
            $api->resource("bill_items", 'BillItemController');
            $api->resource("billable_items", 'BillableItemController');
            $api->resource("payment_options", 'PaymentOptionController');
        });

        $api->resource("countries", 'CountryController');
        $api->resource("currencies", 'CurrencyController');
    });
});