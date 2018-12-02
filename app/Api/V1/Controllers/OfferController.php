<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\OfferRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\Offer;

/**
 * @group Offer
 * Class OfferController
 * @package App\Api\V1\Controllers
 */
class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestHelper::get(Offer::class);
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
     * @param OfferRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OfferRequest $request)
    {
        return RestHelper::store(Offer::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Offer::class,$id);
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
     * @param  OfferRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OfferRequest $request, $id)
    {
        return RestHelper::update(Offer::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Offer::class,$id);
    }
}
