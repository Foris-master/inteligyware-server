<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\DeviceRequest;
use App\Device;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group Device
 *
 * This is the controller used to handle CRUD operations on Device entity
 * Class DeviceController
 * @package App\Api\V1\Controllers
 */
class DeviceController extends Controller
{
    /**
     * This is the entry point used to list all device located inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return RestHelper::get(Device::class);
    }

    /**
     * Store a newly created device in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DeviceRequest $request)
    {
        return RestHelper::store(Device::class, $request->all());
    }

    /**
     * Display the specified device given an id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Device::class,$id);
    }

    /**
     * Update the specified resource in database given an id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DeviceRequest $request,$id)
    {
        return RestHelper::update(Device::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Device::class,$id);
    }
}
