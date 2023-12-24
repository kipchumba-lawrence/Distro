<?php

namespace App\Http\Controllers;

use App\Models\Customer as CustomerModel;
use Illuminate\Http\Request;

class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = CustomerModel::all();
        return view('Customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Customer.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'phone_number' => 'nullable',
            'address' => 'nullable',
        ]);

        CustomerModel::create($validatedData);
        // session()->flash('message', 'Post successfully updated.');
        return redirect()->route('customer.index')->with('success', 'Customer created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
