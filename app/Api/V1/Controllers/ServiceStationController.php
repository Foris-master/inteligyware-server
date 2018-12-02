<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ServiceStationRequest;
use App\ServiceStation;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group ServiceStation
 *
 * This controller is used for the management of match's ServiceStation
 * Class ServiceStationController
 * @package App\Api\V1\Controllers
 */
class ServiceStationController extends Controller
{
    /**
     * Start action, use to show all bills inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RestHelper::get(ServiceStation::class);
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
     * @param ServiceStationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ServiceStationRequest $request)
    {
        return RestHelper::store(ServiceStation::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(ServiceStation::class,$id);
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
     * @param  ServiceStationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ServiceStationRequest $request, $id)
    {
        return RestHelper::update(ServiceStation::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(ServiceStation::class,$id);
    }
}
