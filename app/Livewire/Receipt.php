<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Receipt extends Component
{
    public $order;
    public $total;
    public $customer_id;
    public $cartItems;
    public $selectedCustomer;
    public $orderId;
    public $customerSearch = "";
    public $customerList =[];
    public $paymentOption = "";
    public function render()
    {
        // dd($this->paymentOption);/
        return view('livewire.receipt');
    }
    public function mount()
    {
        $this->order = Cart::with('product')->get();
        $this->total = Cart::sum(DB::raw('quantity * amount'));
    }
    public function paymentProcessing()
    {
    }

    public function customerSearchHandle()
    {
        $this->customerList = Customer::where(function ($query) {
            $query->where('name', 'like', '%' . $this->customerSearch . '%')
                ->orWhere('phone_number', 'like', '%' . $this->customerSearch . '%');
        })->select('name', 'id','phone_number','email')->take(10)->get();
        
    }
    public function addCustomer(){
        $this->selectedCustomer=Customer::find($this->customer_id);
    }
    public function removeCustomer(){
        $this->selectedCustomer=null;
        $this->customer_id=null;
    }
    public function deleteOrder(){
        Cart::truncate();
        redirect()->route('POS')->with('success', 'Order Deleted Succesfully');
    }

    public function checkout()
    {
        $order = new Order();
        if ($this->total >= 5) {
            $order->total_amount = $this->total;
            $order->attended_by = auth()->id();
            $order->customer_id = $this->selectedCustomer->id;
            $order->save();
        } else {
            $order->total_amount = $this->total;
            $order->attended_by = auth()->id();
            $order->save();
        }
        $savedorder = Order::latest()->first();
        $orderid=$savedorder->id;
        $this->cartItems = Cart::with('product')->get();
        foreach ($this->cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->amount = $cartItem->amount;
            $orderDetail->save();

            // Update the product stock in the products table
            $product = Product::find($cartItem->product_id);
            $product->quantity -= $cartItem->quantity;
            $product->save();
        }
        // Clear the cart after successful checkout
        Cart::truncate();
        return redirect()->route('POS', $orderid)->with('success', 'Order Completed Succesfully');
    }
}
