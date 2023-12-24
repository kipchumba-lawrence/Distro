<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Receipt extends Component
{
    public $order;
    public $total;
    public $orderId;
    public $paymentOption = "";
    public function render()
    {
        // dd($this->paymentOption);/
        return view('livewire.receipt');
    }
    public function mount()
    {         $this->order = Cart::with('product')->get();
        $this->total = Cart::sum(DB::raw('quantity * amount'));
    }
    public function paymentProcessing()
    {
    }
    public function Test() 
    {   
        $currentOrder=Order::find($this->orderId);
          
        if ($this->paymentOption == "Mpesa") {
            dd("Need to add Mpesa credentials to handle this payment");
        } else {
            $currentOrder->update([
                'status' => 'paid'
            ]);
        }
        // Print receipt and redirect to the POS route
        // Assuming you have a route named 'POS', you can use the redirect() function to redirect to that route
        // To print the receipt, you can use the dd() function to display the receipt data

        // Add the following code to your Test() function:

        // dd("Receipt printed successfully");
        Cart::truncate();
        return redirect()->route('POS')->with('success', 'Order Completed Succesfully');
    }
}
