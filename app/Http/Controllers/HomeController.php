<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{   
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Total Sales for the day
        $daySales = Order::whereDate('created_at', today())->sum('total_amount');
        // New breakages count for the month
        $breakagesCount = Order::whereMonth('created_at', now()->month)->count();
        // Month Sales
        $monthSales = Order::whereMonth('created_at', now()->month)->sum('total_amount');
        // Top selling products
        $topSellingProducts = Product::with(['orderDetails', 'category'])
        ->select(
            'products.id',
            'products.name',
            'categories.name as category_name',
            DB::raw('SUM(order_details.quantity) as total_quantity'),
            DB::raw('SUM(order_details.quantity * products.price) as total_amount')
        )
        ->join('order_details', 'products.id', '=', 'order_details.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->groupBy('products.id', 'products.name', 'categories.name')
        ->orderByDesc('total_quantity')
        ->take(5)
        ->get();
        // Categories (User to be able to only view the categories and their porducts) 
        $category=Category::all();
        return view('pages.dashboard', compact('daySales', 'breakagesCount', 'monthSales','topSellingProducts','category'));
    }
}
