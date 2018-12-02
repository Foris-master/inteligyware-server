<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\SubscriptionRequest;
use App\Subscription;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group Subscription
 *
 * This controller is used for the management of match's Subscription
 * Class SubscriptionController
 * @package App\Api\V1\Controllers
 */
class SubscriptionController extends Controller
{
    /**
     * Start action, use to show all bills inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RestHelper::get(Subscription::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Action to be execute to store a newly created bill in storage.
     *
     * @param SubscriptionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubscriptionRequest $request)
    {
        return RestHelper::store(Subscription::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Subscription::class,$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubscriptionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SubscriptionRequest $request, $id)
    {
        return RestHelper::update(Subscription::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Subscription::class,$id);
    }
}
