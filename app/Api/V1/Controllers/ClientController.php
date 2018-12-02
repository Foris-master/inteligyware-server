<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ClientRequest;
use App\Client;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;

/**
 * @group Client
 *
 * This controller is used for the management of match's Client
 * Class ClientController
 * @package App\Api\V1\Controllers
 */
class ClientController extends Controller
{
    /**
     * Start action, use to show all bills inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RestHelper::get(Client::class);
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
     * @param ClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClientRequest $request)
    {
        return RestHelper::store(Client::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Client::class,$id);
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
     * @param  ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ClientRequest $request, $id)
    {
        return RestHelper::update(Client::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Client::class,$id);
    }
}
