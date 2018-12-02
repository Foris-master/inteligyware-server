<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\MobileOperatorRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\MobileOperator;

/**
 * @group MobileOperator
 *
 * This class is where we'll implement all action to interact with MobileOperation resource
 * Class MobileOperatorController
 * @package App\Api\V1\Controllers
 */
class MobileOperatorController extends Controller
{
    /**
     * Function which list all MobileOperation located inside the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return RestHelper::get(MobileOperator::class);
    }

    /**
     * Store a newly created MobileOperator in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MobileOperatorRequest $request)
    {
        return RestHelper::store(MobileOperator::class, $request->all());
    }

    /**
     * Display the specified MobileOperator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(MobileOperator::class,$id);
    }

    /**
     * Update the specified MobileOperator in storage given his ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MobileOperatorRequest $request,$id)
    {
        return RestHelper::update(MobileOperator::class,$request->all(),$id);
    }

    /**
     * Remove the specified MobileOperator from database given his ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(MobileOperator::class,$id);
    }
}
