<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function products()
    {
        $products = Product::paginate(5);
        return view('admin.product.productManage',compact('products'));
    }

    public function orders()
    {
        $orders = Order::with('customer')->get();
        // Trả về view orders/index.blade.php và truyền dữ liệu orders
        return view('admin.order.orderManage',compact('orders'));
    }

    public function customers()
    {
        $customers = Customer::paginate(5);
        $orders = Order::paginate(5);
        return view('admin.customer.customerManage',compact('customers','orders'));
    }

    public function mailbox()
    {
        $products = Product::paginate(5);
        return view('admin.oder.oderManage',compact('products'));
    }
}
