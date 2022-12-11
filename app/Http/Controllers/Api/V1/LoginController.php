<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Login;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\LoginResource;
use App\Http\Resources\V1\LoginCollection;
use App\Http\Requests\V1\UpdateLoginRequest;
use App\Http\Requests\V1\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new LoginCollection(Login::paginate());
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
     *
     * @param  \App\Http\Requests\StoreLoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoginRequest $request)
    {
        if(auth()->user()->role == "admin")
        {
            return new LoginResource(Login::create($request->all()));
            return response([
                'message' => 'Success'
            ])->withCookie($cookie);
        }
        else
        {
            return response([
                'message' => 'You are unauthorized!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        if(auth()->user()->role == "admin" || auth()->user()->role == "user")
        {
            return new LoginResource($login);
            return response([
                'message' => 'Success'
            ])->withCookie($cookie);
        }
        else
        {
            return response([
                'message' => 'You are unauthorized!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoginRequest  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoginRequest $request, Login $login)
    {
        if(auth()->user()->role == "admin")
        {
            $login ->update($request->all());
            return response([
                'message' => 'Success'
            ]);
        }
        else
        {
            return response([
                'message' => 'You are unauthorized!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        if(auth()->user()->role == "admin")
        {
            $login->delete();
            return response(null, 204);
        }
        else
        {
            return response([
                'message' => 'You are unauthorized!'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
