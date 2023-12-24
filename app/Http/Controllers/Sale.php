<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sale extends Controller
{
    public function show(){
        return view('POS.index');
    }
    public function receipt(Request $request)
{
    $order=Cart::with('product')->get();
    $orderID=$request->orderID;
    $total=Cart::sum(DB::raw('quantity * amount'));

   return view('POS.receipt', compact('order','orderID','total'));
}}
