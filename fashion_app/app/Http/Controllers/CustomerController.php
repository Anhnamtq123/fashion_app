<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|regex:/^0[0-9]{8,14}$/',
            'address' => 'nullable|string|max:100',
        ]);

        $customer = customer::create([
            'customer_name' => $request->input('customer_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
        ]);

        return back()->with('success', 'Sản phẩm đã được cập nhật!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customer.updateCustomer',['customer' => $customer]);
    }

    public function searchAjax(Request $request)
    {
        $customer_name = $request->input('name');
        // Tìm sản phẩm theo tên
        if (!$customer_name) {
            $customers = Customer::all();
        } else {
            // Tìm sản phẩm theo tên
            $customers = Customer::where('customer_name', 'LIKE', "%$customer_name%")->get();
        }
        return response()->json($customers);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|regex:/^0[0-9]{8,14}$/',
            'address' => 'nullable|string|max:100',
        ]);
    
        $customer = Customer::findOrFail($customer->customer_id); // Tìm khách hàng cần cập nhật

        $customer->update([
            'customer_name' => $request->input('customer_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
        ]);

        return back()->with('success', 'Sản phẩm đã được cập nhật!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer = Customer::findOrFail($customer->customer_id);
    
        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $customer->delete();
    
        // Trả về thông báo thành công và quay lại trang trước
        return back()->with('success', 'Sản phẩm đã được xóa!');
    }
}
