<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\BillRequest;
use App\Bill;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group Bill
 *
 * This controller is used for the management of match's Bill
 * Class BillController
 * @package App\Api\V1\Controllers
 */
class BillController extends Controller
{
    /**
     * Start action, use to show all bills inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RestHelper::get(Bill::class);
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
     * @param BillRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BillRequest $request)
    {
        return RestHelper::store(Bill::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Bill::class,$id);
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
     * @param  BillRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BillRequest $request, $id)
    {
        return RestHelper::update(Bill::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Bill::class,$id);
    }
}
