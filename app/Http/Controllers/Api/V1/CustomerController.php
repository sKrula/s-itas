<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Services\V1\CustomerQuery;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreCustomerRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new CustomerQuery();
        $queryItems = $filter ->transform($request); //[['column', 'operator', 'value']]

        $includeWallets = $request->query('include');

        if(count($queryItems) == 0) {
            return new CustomerCollection(Customer::paginate());
        }
        else{
            return new CustomerCollection(Customer::where($queryItems)->paginate());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
        //return $customer;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer ->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if(auth()->user()->role == "admin" || auth()->user()->role == "user")
        {
            $customer->delete();
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
