<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WalletResource;
use App\Http\Resources\V1\WalletCollection;
use App\Http\Requests\V1\StoreWalletRequest;
use App\Http\Requests\V1\UpdateWalletRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new WalletCollection(Wallet::paginate());
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
     * @param  \App\Http\Requests\StoreWalletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalletRequest $request)
    {
        if(auth()->user()->role == "admin")
        {
            return new WalletResource(Wallet::create($request->all()));
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
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        if(auth()->user()->role == "admin" || auth()->user()->role == "user")
        {
            return new WalletResource($wallet);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWalletRequest  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        if(auth()->user()->role == "admin")
        {
            $wallet ->update($request->all());
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        if(auth()->user()->role == "admin")
        {
            $wallet->delete();
            return response(null, 204);
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
}
