<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\PatnerRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\Patner;

/**
 * @group Patner
 * Class PatnerController
 * @package App\Api\V1\Controllers
 */
class PatnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestHelper::get(Patner::class);
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
     * @param PatnerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PatnerRequest $request)
    {
        return RestHelper::store(Patner::class,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Patner::class,$id);
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
     * @param  PatnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PatnerRequest $request, $id)
    {
        return RestHelper::update(Patner::class,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Patner::class,$id);
    }
}
