<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\SubscriptionUserRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\SubscriptionUser;

/**
 * @group SubscriptionUser
 * This class is intended to manage all actions related to SubscriptionUser resource
 * Class SubscriptionUserController
 * @package App\Api\V1\Controllers
 */
class SubscriptionUserController extends Controller
{
    /**
     * Entry point where we list all towns from the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return RestHelper::get(SubscriptionUser::class);
    }

    /**
     * Store a newly created town in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubscriptionUserRequest $request)
    {
        return RestHelper::store(SubscriptionUser::class, $request->all());
    }

    /**
     * Display the specified town.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(SubscriptionUser::class,$id);
    }

    /**
     * Update the specified town in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SubscriptionUserRequest $request,$id)
    {
        return RestHelper::update(SubscriptionUser::class,$request->all(),$id);
    }

    /**
     * Remove the specified town from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(SubscriptionUser::class,$id);
    }

}
