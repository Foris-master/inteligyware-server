<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\RatingRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\Rating;

/**
 * @group Rating
 * This class is intended to manage all action related to Rating resource
 * Class RatingController
 * @package App\Api\V1\Controllers
 */
class RatingController extends Controller
{
    /**
     * Entry point, we list all Rating store into the database
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return RestHelper::get(Rating::class);
    }

    /**
     * Store a newly created Rating in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RatingRequest $request)
    {
        return RestHelper::store(Rating::class, $request->all());
    }

    /**
     * Display the specified Rating.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(Rating::class,$id);
    }

    /**
     * Update the specified Rating in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RatingRequest $request,$id)
    {
        return RestHelper::update(Rating::class,$request->all(),$id);
    }

    /**
     * Remove the specified Rating from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(Rating::class,$id);
    }

}
