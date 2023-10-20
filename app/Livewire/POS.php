<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderDetail;
use Illuminate\Http\Request;


class POS extends Component
{
    public $products;
    public $cartItems;
    public $cartTotal;
    public function mount()
    {
        $this->products = Product::where('quantity', '>', 0)->with('category')->get();
    }
    public function render()
    {
        $this->cartItems = Cart::with('product')->get();
        $this->cartTotal = Cart::sum('amount');
        return view('livewire.p-o-s');
    }
    public function addToCart($productID)
    {
        $product = Product::find($productID);

        $cartItem = Cart::where('product_id', $productID)->first();

        if ($product && !$cartItem) {
            $cart = new Cart();
            $cart->product_id = $productID;
            $cart->quantity = 1;
            $cart->amount = $product->price;
            $cart->save();
        } else {
            notify()->success('Already added!');
        }
    }
    public function update($itemID, Request $request)
    {
        $item = Cart::where('id', $itemID)->first();
        $price = Product::where('id', $item->product_id)->select('price')->get();
        $price = $price[0]->price;
        dd($request->input('quantity'));
    }
    public function removeFromCart($itemID)
    {
        Cart::where('id', $itemID)->delete();
    }
    public function checkout()
    {
        $order = new Order();
        $order->total_amount = $this->cartTotal;
        $order->attended_by = auth()->id();
        $order->save();
    
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
    }
    
}
