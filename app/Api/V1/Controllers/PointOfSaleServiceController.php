<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\PointOfSaleServiceRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\PointOfSaleService;

/**
 * @group PointOfSaleService
 * Class PointOfSaleServiceController
 * @package App\Api\V1\Controllers
 */
class PointOfSaleServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestHelper::get(PointOfSaleService::class);
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
     * @param PointOfSaleServiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PointOfSaleServiceRequest $request)
    {
        return RestHelper::store(PointOfSaleService::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(PointOfSaleService::class,$id);
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
     * @param  PointOfSaleServiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PointOfSaleServiceRequest $request, $id)
    {
        return RestHelper::update(PointOfSaleService::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(PointOfSaleService::class,$id);
    }
}
