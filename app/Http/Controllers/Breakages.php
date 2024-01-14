<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $breakages = Breakage::with('product', 'user')->where('cleared_status', 0)->get();
        return view('Breakages.index', compact('breakages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with('category')->get();
        $users = User::select('id', 'firstname', 'lastname')->get();
        return view('Breakages.create', compact('products', 'users'));
    }

    public function approved()
    {
        $approvedBreakages = Breakage::where('cleared_status', 1)->with('user:first_name,last_name', 'product:name,category,price,quantity')->get();
        return view('breakages.approved', compact('approvedBreakages'));
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
           'date_of_breakage' => 'required',
           'reason' => 'required',
       ]);
   
       $breakage = Breakage::create([
           'product_id' => $request->product_id,
           'user_id' => $request->user_id,
           'quantity' => $request->quantity,
           'date_of_breakage' => $request->date_of_breakage,
           'reason' => $request->reason,
       ]);
   
       $brokenProduct = Product::find($request->product_id);
       $brokenProduct->quantity -= $request->quantity;
       $brokenProduct->save();
   
       return redirect()->route('breakages.create');
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
    public function cleared($id)
    {
        $breakage = Breakage::find($id);
        $breakage->cleared_status = 1;
        $breakage->approved_date = date('Y-m-d');
        $breakage->save();
        return redirect()->route('breakages.index');
    }
    public function destroy(string $id)
    {
        //
    }
}
