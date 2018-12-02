<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\StationRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\Station;

/**
 * @group Station
 * This class is intended to manage all actions related to Station resource
 * Class StationController
 * @package App\Api\V1\Controllers
 */
class StationController extends Controller
{
    /**
     * Entry point where we list all towns from the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return RestHelper::get(Station::class);
    }

    /**
     * Store a newly created town in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StationRequest $request)
    {
        return RestHelper::store(Station::class, $request->all());
    }

    /**
     * Display the specified town.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Station::class,$id);
    }

    /**
     * Update the specified town in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StationRequest $request,$id)
    {
        return RestHelper::update(Station::class,$request->all(),$id);
    }

    /**
     * Remove the specified town from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Station::class,$id);
    }

}
