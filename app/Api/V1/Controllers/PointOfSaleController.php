<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\PointOfSaleRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\PointOfSale;

/**
 * @group PointOfSale
 * Class PointOfSaleController
 * @package App\Api\V1\Controllers
 */
class PointOfSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestHelper::get(PointOfSale::class);
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
     * @param PointOfSaleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PointOfSaleRequest $request)
    {
        return RestHelper::store(PointOfSale::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(PointOfSale::class,$id);
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
     * @param  PointOfSaleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PointOfSaleRequest $request, $id)
    {
        return RestHelper::update(PointOfSale::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(PointOfSale::class,$id);
    }
}
