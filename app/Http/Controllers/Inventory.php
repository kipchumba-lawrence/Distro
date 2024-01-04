<?php

namespace App\Http\Controllers;

use App\Models\inventory as InventoryModel;
use App\Models\Product;
use Illuminate\Http\Request;

class Inventory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Inventory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('Inventory.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Update product model with new inventory
        $product = Product::find($request->product)->first();
        $product->quantity = $product->quantity + $request->quantity;
        $product->save();
        return redirect()->route('inventory.create')->with('success', 'Inventory Updated Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Create a new inventory model
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
