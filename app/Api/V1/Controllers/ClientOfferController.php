<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ClientOfferRequest;
use App\ClientOffer;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group ClientOffer
 *
 * This controller is used for the management of match's ClientOffer
 * Class ClientOfferController
 * @package App\Api\V1\Controllers
 */
class ClientOfferController extends Controller
{
    /**
     * Start action, use to show all bills inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RestHelper::get(ClientOffer::class);
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
     * @param ClientOfferRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClientOfferRequest $request)
    {
        return RestHelper::store(ClientOffer::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(ClientOffer::class,$id);
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
     * @param  ClientOfferRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ClientOfferRequest $request, $id)
    {
        return RestHelper::update(ClientOffer::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(ClientOffer::class,$id);
    }
}
