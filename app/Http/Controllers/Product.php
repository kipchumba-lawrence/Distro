<?php

namespace App\Http\Controllers;

use App\Models\Product as ProductModel;
use App\Models\Category;
use Illuminate\Http\Request;

class Product extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductModel::with('category')->get();
        // dd($products[0]);
        return view('Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('name', 'id')->get();
        // get the unique values of packaging field in the category model
        $packaging = ProductModel::select('packaging')->distinct()->get();
        return view('Product.create', compact('categories', 'packaging'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required',
            'packaging' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        // Use the create method to create and save a new Product
        ProductModel::create($validatedData);

        // Redirect back or wherever you want after saving
        return redirect()->back()->with('success', 'Product created successfully');
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
