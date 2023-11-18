<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Breakage;
use Illuminate\Http\Request;

class Breakages extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
return view('Breakages.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('category')->get();
        $users= User::select('id','firstname','lastname')->get();
        return view('Breakages.create', compact('products','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
            public function store(Request $request)
            {   
                $request->validate([
                    'product_id' => 'required',
                    'user_id' => 'required',
                    'quantity' => 'required',
                    'date_of_breakage' => 'required'
                ]);
            
                // Save the breakages record to the database
                $breakage = new Breakage;
                $breakage->product_id = $request->product_id;
                $breakage->user_id = $request->user_id;
                $breakage->quantity = $request->quantity;
                $breakage->date_of_breakage = $request->date_of_breakage;
                $breakage->save();
                            // add some toast messages to show message has been saved


                            //TODO:Handle the stock changes 


                // Redirect to another page or return a response
                return redirect()->route('breakages.index');
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
