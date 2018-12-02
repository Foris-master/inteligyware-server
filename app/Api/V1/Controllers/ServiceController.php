<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ServiceRequest;
use App\Service;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group Service
 *
 * This controller is used for the management of match's Service
 * Class ServiceController
 * @package App\Api\V1\Controllers
 */
class ServiceController extends Controller
{
    /**
     * Start action, use to show all bills inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RestHelper::get(Service::class);
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
     * @param ServiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ServiceRequest $request)
    {
        return RestHelper::store(Service::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Service::class,$id);
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
     * @param  ServiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ServiceRequest $request, $id)
    {
        return RestHelper::update(Service::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Service::class,$id);
    }
}
