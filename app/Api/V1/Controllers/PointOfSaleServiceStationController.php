<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\PointOfSaleServiceStationRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\PointOfSaleServiceStation;

/**
 * @group PointOfSaleServiceStation
 * Class PointOfSaleServiceStationController
 * @package App\Api\V1\Controllers
 */
class PointOfSaleServiceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestHelper::get(PointOfSaleServiceStation::class);
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
     * Store a newly created resource in storage.
     * @param PointOfSaleServiceStationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PointOfSaleServiceStationRequest $request)
    {
        return RestHelper::store(PointOfSaleServiceStation::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(PointOfSaleServiceStation::class,$id);
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
     * @param  PointOfSaleServiceStationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PointOfSaleServiceStationRequest $request, $id)
    {
        return RestHelper::update(PointOfSaleServiceStation::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(PointOfSaleServiceStation::class,$id);
    }
}
