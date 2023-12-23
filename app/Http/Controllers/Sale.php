<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sale extends Controller
{
    public function show(){
        return view('POS.index');
    }
    public function receipt()
{
    return view('POS.receipt');
}}
