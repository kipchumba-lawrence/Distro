<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;


class POS extends Component
{
    public $products;
    public $cartItems;
    public $cartTotal;
    public $customer_search;
    public $customer;
    public $selectedCustomer;
    public $searchTerm = '';
    public function mount()
    {
        $this->products = Product::where('quantity', '>', 0)->with('category')->get();
    }
    public function render()
    {
        $this->cartItems = Cart::with('product')->get();
        $this->customer = Customer::where('name', 'like', '%' . $this->customer_search . '%')->select('name', 'id')->take(10)->get();
        $this->cartTotal = Cart::sum(DB::raw('quantity * amount'));
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
    public function removeFromCart($itemID)
    {
        Cart::where('id', $itemID)->delete();
    }
    public function checkout()
    {
        $order = new Order();
        if ($this->cartTotal >= 5) {
            $order->total_amount = $this->cartTotal;
            $order->attended_by = auth()->id();
            $order->customer_id = $this->selectedCustomer;
            $order->save();
        } else {
            $order->total_amount = $this->cartTotal;
            $order->attended_by = auth()->id();
            $order->save();
        }

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
        // Cart::truncate();
        return redirect()->route('receipt')->with('success', 'Order Created Succesfully');
    }
    public function selectCustomer($id)
    {
        $this->selectedCustomer = $id;
    }

    public function addQuantity($itemID)
    {
        $item = Cart::where('id', $itemID)->with('product')->first();
        $inventory = $item->product->quantity;
        if ($item->quantity < $inventory) {
            $item->quantity += 1;
            $item->save();
        } else {
            session()->flash('success', 'Inventory Updated Successfully');
        }
    }
    public function removeQuantity($itemID)
    {

        $item = Cart::where('id', $itemID)->first();
        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        } else {
            $this->dispatchBrowserEvent('show-success-alert', ['message' => 'Inventory Updated Successfully']);
        }
    }
    public function clearCart()
    {
        Cart::truncate();
    }
    public function productSearch()
    {
        $this->products = Product::where('name', 'like', '%' . $this->searchTerm . '%')->get();
    }
    public function clearSearch(){
        $this->searchTerm = '';
    }
}
