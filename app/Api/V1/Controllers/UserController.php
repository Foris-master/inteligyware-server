<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\UserRequest;
use App\Helpers\RestHelper;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

/**
 * @group User
 *
 * Controller allowing user to get connected, to create session
 * Class UserController
 * @package App\Api\V1\Controllers
 */
class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }

    
    public function index(){
        return RestHelper::get(User::class);
    }

    /**
     * Store a newly created town in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        return RestHelper::store(User::class, $request->all());
    }

    /**
     * Display the specified town.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return RestHelper::show(User::class,$id);
    }

    /**
     * Update the specified town in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        return RestHelper::update(User::class,$request->all(),$id);
    }

    /**
     * Remove the specified town from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return RestHelper::destroy(User::class,$id);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(){
        return response()->json(Auth::guard()->user());
    }
}
